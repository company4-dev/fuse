<?php

namespace Fuse\Traits;

use Illuminate\Pagination\LengthAwarePaginator;
use ReflectionMethod;

trait BaseTable
{
    private $actions = [];
    private $columns = [];

    public function __construct(
        private $id   = null,
        private $data = null
    ) {
    }

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

                    $view = str_contains('::', $action['route']) ? explode('::', $action['route'])[1] : $action['route'];

                    $view = explode('.', $view);
                    $view = $view[count($view) - 1];

                    if (in_array($view, ['edit', 'view']) || $action['type'] === 'view') {
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

        $columns      = $this->getColumns();
        $default_sort = null;
        $filter       = $table->form->filter;
        $model        = self::MODEL;

        $columns[]    = 'id';
        $default_sort = $model::defaultSort();

        $columns = array_unique(array_merge($columns, array_keys($default_sort)));

        $query = $model
            ::select($columns)
            ->when(
                method_exists($model, 'withTrashed'),
                fn ($query) => $query->orderByRaw('deleted_at IS NULL DESC')
            )
            ->when(
                method_exists($table->form, 'query'),
                fn ($query) => $table->form->query($query, $table->id, $filter, $table->data)
            )
            ->when(
                method_exists(self::class, 'query'),
                fn ($query) => self::query($query, $table->id, $filter, $table->data)
            );

        // Replace $columns in case we've added any move via `addSelect`
        $columns = $query->getQuery()->columns;

        $query = $query->when(
            $table->form->search,
            fn ($query) => $query->search($table->form->search, $columns)
        );

        foreach ($default_sort as $column => $sort) {
            $query->orderBy($column, $sort);
        }

        return $query->paginate(config('settings.lists.items-per-page'));
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

    public function hasActions(): bool
    {
        $end        = null;
        $start      = null;
        $reflection = new ReflectionMethod(self::class, 'actions');

        $end   = $reflection->getEndLine() - 1;
        $start = $reflection->getStartLine() + 1;

        if ($start > $end) {
            return false; // Empty method
        }

        $file_path = $reflection->getFileName();
        $lines     = file($file_path);
        $body      = array_slice($lines, $start, $end - $start);
        $body      = trim(implode('', $body));

        return !in_array($body, ['return [];', 'return null;']);
    }

    abstract protected function actions($model): ?array;

    abstract protected function columns(?int $id = null, ?array $dataset = null): array;

    private function init()
    {
        if (!$this->columns) {
            $this->columns = $this->columns($this->id, $this->data);
        }
    }
}
