<?php

namespace Fuse\Traits;

use Illuminate\Pagination\LengthAwarePaginator;

trait Table
{
    private $actions = [];
    private $columns = [];

    public function getActions(): array
    {
        $this->init();

        foreach ($this->actions as $action) {
            if ($action['type'] === 'view') {
                $action['label'] = __('View');
            }

            $view = explode('.', $action['route'])[1];

            if (in_array($view, ['edit', 'view'])) {
                $action['id'] = fn ($model) => $model->id;
            }

            $actions[] = $action;
        }

        return $actions;
    }

    public function getModels(): LengthAwarePaginator
    {
        $this->init();

        $columns = $this->getColumns();
        $model   = self::MODEL;

        return $model::select($columns)->paginate(20);
    }

    public function getColumns(): array
    {
        $this->init();

        $columns = [];

        foreach ($this->columns as $data) {
            $columns = array_merge($columns, (array) $data['columns']);
        }

        return $columns;
    }

    public function getHeaders(): array
    {
        $this->init();

        return $this->columns;
    }

    abstract protected function actions(): array;

    abstract protected function columns(): array;

    private function init()
    {
        if (!$this->actions) {
            $this->actions = $this->actions();
        }

        if (!$this->columns) {
            $this->columns = $this->columns();
        }
    }
}
