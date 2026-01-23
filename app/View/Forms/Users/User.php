<?php

namespace Fuse\View\Forms\Users;

use Fuse\Models\Role;
use Fuse\Traits\BaseLivewireForm;
use Livewire\Form;

class User extends Form
{
    use BaseLivewireForm;

    public string $email      = '';
    public string $first_name = '';
    public string $last_name  = '';

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
            'dictionary.name' => [
                [
                    'label'    => 'phrases.first-name',
                    'name'     => 'first_name',
                    'required' => true,
                    'type'     => 'text',
                ],
                [
                    'label'    => 'phrases.last-name',
                    'name'     => 'last_name',
                    'required' => true,
                    'type'     => 'text',
                ],
            ],
            'dictionary.email' => [
                [
                    'label'    => 'dictionary.email',
                    'name'     => 'email',
                    'required' => true,
                    'type'     => 'email',
                ],
            ],
            'dictionary.access' => [
                [
                    'description' => 'messages.features.users.base-role',
                    'label'       => 'phrases.base-role',
                    'name'        => 'role_id',
                    'options'     => Role::pluck('name', 'id')->toArray(),
                    'type'        => 'options',
                ],
            ],
        ];
    }

    public function setModel($user, object $component): void
    {
        $this->email      = $user->email;
        $this->first_name = $user->first_name;
        $this->last_name  = $user->last_name;
    }
}
