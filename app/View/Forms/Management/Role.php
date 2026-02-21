<?php

namespace App\View\Forms\Management;

use App\Traits\BaseLivewireForm;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Form;

class Role extends Form
{
    use BaseLivewireForm;

    private ?int $id          = null;
    public array $options     = [];
    public array $permissions = [];
    public string $name       = '';

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
        $fields = [
            'dictionary.details' => [
                [
                    'label'    => 'dictionary.name',
                    'name'     => 'name',
                    'required' => true,
                    'rules'    => [
                        $this->id
                            ? Rule::unique('roles', 'name')->ignore($this->id, 'id')
                            : null,
                    ],
                    'type' => 'text',
                ],
            ],
            'dictionary.permissions' => [],
        ];

        foreach ($this->options as $platform => $permissions) {
            $fields['dictionary.permissions'][] = [
                'label'    => $platform,
                'multiple' => true,
                'name'     => 'permissions.'.Str::slug($platform),
                'options'  => $permissions,
                'required' => true,
                'type'     => 'options',
            ];
        }

        return $fields;
    }

    public function setModel($role, object $component): void
    {
        $this->id   = $role->id;
        $this->name = $role->name;

        foreach ($role->permissions as $permission) {
            $this->permissions[Str::slug($permission->platform_name)][] = $permission->id;
        }
    }
}
