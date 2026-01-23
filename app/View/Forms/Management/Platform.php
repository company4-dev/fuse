<?php

namespace Fuse\View\Forms\Management;

use Fuse\Traits\BaseLivewireForm;
use Livewire\Form;

class Platform extends Form
{
    use BaseLivewireForm;

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

    public function setModel($repository, object $component): void
    {
    }
}
