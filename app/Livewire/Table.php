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
        $fuse = null;
        $path = '\\View\\Tables';

        if (str_contains($table, '::')) {
            [$fuse, $table] = explode('::', $table);

            $table_class = '\\Fuses\\'.Str::studly($fuse);
        } else {
            $table_class = '\\App';
        }

        $namespace = implode('\\', array_map(
            fn ($folder) => Str::studly($folder),
            explode('.', $table)
        ));

        $table_class .= $path.'\\'.$namespace;

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

        $models = $table->getModels($table);

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
