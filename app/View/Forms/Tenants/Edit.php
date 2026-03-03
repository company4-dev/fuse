<?php

namespace App\View\Forms\Tenants;

use App\Traits\BaseLivewireForm;
use Livewire\Form;

class Edit extends Form
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
                    'type'     => 'text',
                    'value'    => $this->name,
                ],
            ],
        ];
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
            ],
        ];
    }

    public function setModel($tenant, object $component): void
    {
        $this->name = $tenant->name;
    }
}
