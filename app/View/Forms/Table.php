<?php

namespace App\View\Forms;

use App\Helpers\Translations;
use App\Traits\BaseLivewireForm;
use Livewire\Form;

class Table extends Form
{
    use BaseLivewireForm;

    public array $filter  = [];
    public ?int $deleted  = 0;
    public string $search = '';

    public function actions(): array
    {
        return [];
    }

    public function fields(): array
    {
        $fields = [
            'dictionary.search' => [
                [
                    'label'    => 'dictionary.search',
                    'modifier' => 'live',
                    'name'     => 'search',
                    'type'     => 'search',
                ],
            ],
        ];

        if (method_exists($this->component->table_class::MODEL, 'bootSoftDeletes')) {
            $fields['dictionary.search'][] = [
                'label'       => 'dictionary.deleted',
                'modifier'    => 'change',
                'name'        => 'deleted',
                'options'     => array_map(___(...), Translations::yes_no()),
                'placeholder' => 'dictionary.all',
                'type'        => 'options',
            ];
        }

        return $fields;
    }

    public function query($query)
    {
        if ($this->deleted === 1) {
            $query = $query->onlyTrashed();
        } elseif ($this->deleted === null) {
            $query = $query->withTrashed();
        }

        return $query;
    }

    public function setModel($model, object $component): void
    {
    }
}
