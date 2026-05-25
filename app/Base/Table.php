<?php

declare(strict_types=1);

namespace App\Base;

use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use ReflectionMethod;

abstract class Table
{
    private array $columns = [];

    public function __construct(
        private $id   = null,
        private $data = null
    ) {}

    public function getActions($model): array
    {
        $this->init();

        $actions         = [];
        $defined_actions = $this->actions($model);

        if ($defined_actions) {
            foreach ($defined_actions as $action) {
                $action['href']   ??= null;
                $action['label']  ??= $action['type'] === 'view' ? 'dictionary.view' : $action['label'];
                $action['route']  ??= null;
                $action['target'] ??= '_self';
                $action['type']   ??= null;

                if ($action['route']) {
                    if (is_array($action['route'])) {
                        $action['id']    = $action['route'][1];
                        $action['route'] = $action['route'][0];
                    }

                    $view = str_contains('::', $action['route'])
                        ? explode('::', $action['route'])[1]
                        : $action['route'];

                    $view = explode('.', $view);
                    $view = $view[count($view) - 1];

                    if (in_array($view, ['edit', 'view'], true) || $action['type'] === 'view') {
                        $action['id'] ??= $model->id;
                    }
                }

                $actions[] = $action;
            }
        }

        return $actions;
    }

    public function getModels($table): LengthAwarePaginator
    {
        $this->init();

        return $this->getQuery($table)->paginate(config('settings.lists.items-per-page'));
    }

    public function getColumns(): array
    {
        $this->init();

        $columns = [];

        foreach ($this->columns as $key => $data) {
            if ($key === 'debug') {
                continue;
            }

            if (!array_key_exists('columns', $data)) {
                $data['columns'] = [];
            }

            if (is_string($data['columns'])) {
                $data['columns'] = [
                    $data['columns'],
                ];
            }

            $columns = array_merge($columns, $data['columns']);
        }

        return array_unique($columns);
    }

    public function getHeaders(): array
    {
        $this->init();

        $columns = [];

        foreach ($this->columns as $name => $data) {
            $columns[$name] = $data;
        }

        return $columns;
    }

    public function getQuery($table): Builder
    {
        $columns         = $this->getColumns();
        $default_sort    = null;
        $filter          = $table->form->filter;
        $filtered_filter = null;
        $joins           = [];
        $model           = static::MODEL;
        $query           = $model::query();
        $table_name      = $query->getModel()->getTable();

        $columns[]       = 'id';
        $default_sort    = $model::defaultSort();
        $filtered_filter = $filter;

        unset($filtered_filter['deleted']);
        unset($filtered_filter['search']);

        $columns = array_unique(array_merge($columns, array_keys($default_sort)));

        foreach ($columns as &$column) {
            if (str_contains($column, '.')) {
                [$relation_name, $field] = explode('.', $column);
                $relation                = $query->getModel()->{$relation_name}();
                $related_table           = $relation->getRelated()->getTable();

                $column                = $related_table.'.'.$field.' as '.$relation_name.'_'.$field;
                $joins[$related_table] = [
                    $related_table,
                    $table_name.'.'.$relation->getForeignKeyName(),
                    '=',
                    $related_table.'.'.$relation->getOwnerKeyName(),
                ];
            } else {
                $column = $table_name.'.'.$column;
            }
        }

        unset($column);

        foreach ($joins as $join) {
            $query = $query->join(...$join);
        }

        $query = $query
            ->select($columns)
            ->when(
                method_exists($model, 'withTrashed'),
                static fn ($query) => $query->orderByRaw('deleted_at IS NULL DESC')
            )
            ->when(
                method_exists($table->form, 'query'),
                static fn ($query) => $table->form->query($query, $table->id, $filtered_filter, $table->data)
            )
            ->when(
                method_exists($table->table_class, 'query'),
                fn ($query) => (new $table->table_class)->query($query, $table->id, $filtered_filter, $table->data)
            );

        // Replace $columns in case we've added any move via `addSelect`
        $columns = $query->getQuery()->columns;

        foreach ($columns as &$column) {
            if (!str_contains($column, '.')) {
                $column = $table_name.'.'.$column;
            }
        }

        unset($column);

        $query = $query->select(array_unique($columns));

        $query = $query->when(
            $table->form->filter['search'],
            static fn ($query) => $query->search($table->form->filter['search'], $columns)
        );

        foreach ($default_sort as $column => $sort) {
            if (!str_contains($column, '.')) {
                $column = $table_name.'.'.$column;
            }

            $query->orderBy($column, $sort);
        }

        return $query;
    }

    public function hasActions(): bool
    {
        $end        = null;
        $start      = null;
        $reflection = new ReflectionMethod(static::class, 'actions');

        $end   = $reflection->getEndLine() - 1;
        $start = $reflection->getStartLine() + 1;

        if ($start > $end) {
            return false; // Empty method
        }

        $file_path = $reflection->getFileName();
        $lines     = file($file_path);
        $body      = array_slice($lines, $start, $end - $start);
        $body      = trim(implode('', $body));

        return !in_array($body, ['return [];', 'return null;'], true);
    }

    abstract public function actions($model): ?array;

    abstract protected function columns(?int $id = null, ?array $dataset = null): array;

    private function init(): void
    {
        if (!$this->columns) {
            $this->columns = $this->columns($this->id, $this->data);

            foreach ($this->columns as $column => $data) {
                if (!array_key_exists('value', $data)) {
                    continue;
                }

                if (!is_callable($data['value'])) {
                    continue;
                }

                if (!is_array($data['value'])) {
                    throw new Exception(___(
                        'errors.exceptions.components.table.invalid-column-value-callback',
                        $column
                    ));
                }
            }
        }
    }
}
