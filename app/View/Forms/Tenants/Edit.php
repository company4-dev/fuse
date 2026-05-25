<?php

declare(strict_types=1);

namespace App\View\Forms\Tenants;

use App\Base\LivewireForm;

class Edit extends LivewireForm
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

    protected function setModel($tenant, object $component): void
    {
        $this->name = $tenant->name;
    }
}
