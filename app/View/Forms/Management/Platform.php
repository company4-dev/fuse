<?php

declare(strict_types=1);

namespace App\View\Forms\Management;

use App\Base\LivewireForm;

class Platform extends LivewireForm
{
    public string $name       = '';
    public string $repository = '';

    public function actions(): array
    {
        return [
            [
                'component' => 'field',
                'label'     => 'dictionary.save',
                'name'      => 'save',
                'type'      => 'submit',
            ],
        ];
    }

    public function fields(): array
    {
        return [
            'dictionary.platform' => [
                [
                    'label'    => 'dictionary.name',
                    'name'     => 'name',
                    'required' => true,
                    'type'     => 'text',
                ],
                [
                    'label'    => 'dictionary.repository',
                    'name'     => 'repository',
                    'required' => true,
                    'rules'    => [
                        'regex:/^git@[a-zA-Z0-9._-]+:[a-zA-Z0-9._-]+\/[a-zA-Z0-9._-]+(\.git)?$/',
                    ],
                    'type' => 'text',
                ],
            ],
        ];
    }

    protected function setModel($repository, object $component): void {}
}
