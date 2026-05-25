<?php

declare(strict_types=1);

namespace App\View\Forms;

use App\Base\LivewireForm;
use App\Helpers\Translations;

class Table extends LivewireForm
{
    public array $filter = [
        'deleted' => 0,
        'export'  => null,
        'search'  => null,
    ];

    public function actions(): array
    {
        return [
            [
                'component' => 'field',
                'label'     => 'dictionary.export',
                'name'      => 'filter.export',
                'type'      => 'submit',
            ],
        ];
    }

    public function fields(): array
    {
        $fields = [
            'dictionary.search' => [
                [
                    'label'    => 'dictionary.search',
                    'modifier' => 'live',
                    'name'     => 'filter.search',
                    'type'     => 'search',
                ],
            ],
        ];

        if (method_exists($this->component->table_class::MODEL, 'bootSoftDeletes')) {
            $fields['dictionary.search'][] = [
                'label'       => 'dictionary.deleted',
                'modifier'    => 'change',
                'name'        => 'filter.deleted',
                'options'     => array_map(___(...), Translations::yes_no()),
                'placeholder' => 'dictionary.all',
                'type'        => 'options',
            ];
        }

        return array_merge(
            $fields,
            [
                'dictionary.filter' => array_map(
                    static function (array $field): array {
                        $field['name'] = 'filter.'.$field['name'];

                        return $field;
                    },
                    method_exists($this->component->table_class, 'filters')
                        ? new $this->component->table_class()->filters()
                        : [],
                ),
            ],
        );
    }

    public function query($query)
    {
        $deleted = $this->filter['deleted'] === '' ? null : (int) $this->filter['deleted'];

        if ($deleted === 1) {
            $query = $query->onlyTrashed();
        } elseif ($deleted === null) {
            $query = $query->withTrashed();
        }

        return $query;
    }

    protected function setModel($model, object $component): void {}
}
