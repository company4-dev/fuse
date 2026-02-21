<?php

namespace App\Livewire;

use Illuminate\Support\Str;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    public $model;
    public $table_class;

    public function mount($table)
    {
        $module      = null;
        $table_class = 'Platforms\\';

        [$module, $feature, $table] = array_pad(explode('.', $table), 3, null);

        $table_class .= Str::studly($module).'\\View\\Tables\\';

        if (!$table) {
            $table = $feature;
        } else {
            $table_class = Str::studly($feature).'\\';
        }

        $table_class .= Str::studly($table);

        $this->model       = $table_class::MODEL;
        $this->table_class = $table_class;
    }

    public function placeholder()
    {
        return <<<'HTML'
            <div class="flex justify-center p-10">
                <span class="loading loading-spinner text-primary"></span>
            </div>
        HTML;
    }

    public function render(): View
    {
        $table = new $this->table_class;

        $models = $table->getModels();

        return view(
            'livewire.table',
            [
                'actions' => $table->getActions(),
                'columns' => $table->getHeaders(),
                'models'  => $models,
            ]
        );
    }
}
