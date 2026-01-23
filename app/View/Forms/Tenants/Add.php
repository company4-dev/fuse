<?php

namespace Fuse\View\Forms\Tenants;

use Fuse\Traits\BaseLivewireForm;
use Livewire\Form;

class Add extends Form
{
    use BaseLivewireForm;

    public string $name = '';

    public function actions(): array
    {
        return [
            [
                'component' => 'field',
                'label'     => 'dictionary.save',
                'name'      => 'save',
                'type'      => 'submit',
                'variant'   => 'primary',
            ],
        ];
    }

    public function fields(): array
    {
        return [
            'dictionary.account' => [
                [
                    'label'    => 'dictionary.name',
                    'name'     => 'name',
                    'required' => true,
                    'rules'    => [
                        'unique:tenants,name',
                    ],
                    'type' => 'text',
                ],
            ],
        ];
    }

    public function setModel($model, object $component): void
    {
    }
}
