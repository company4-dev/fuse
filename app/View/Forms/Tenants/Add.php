<?php

declare(strict_types=1);

namespace App\View\Forms\Tenants;

use App\Base\LivewireForm;

class Add extends LivewireForm
{
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

    protected function setModel($model, object $component): void {}
}
