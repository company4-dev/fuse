<?php

namespace App\View\Forms\Users;

use App\Traits\BaseLivewireForm;
use Illuminate\Support\Facades\Auth;
use Livewire\Form;

class Profile extends Form
{
    use BaseLivewireForm;

    public string $email                     = '';
    public string $existing_password         = '';
    public string $first_name                = '';
    public string $last_name                 = '';
    public string $new_password              = '';
    public string $new_password_confirmation = '';

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
                    'rules'    => [
                        'unique:users,email,'.Auth::id(),
                    ],
                    'type' => 'email',
                ],
            ],
            'dictionary.password' => [
                'description' => 'messages.pages.profile.new-password',
                'fields'      => [
                    [
                        'label'    => 'phrases.existing-password',
                        'modifier' => 'blur',
                        'name'     => 'existing_password',
                        'rules'    => [
                            'allow-insecure',
                            'current-password',
                        ],
                        'type' => 'password',
                    ],
                    [
                        'label'    => 'phrases.new-password',
                        'name'     => 'new_password',
                        'required' => $this->existing_password !== '',
                        'type'     => 'password',
                    ],
                    [
                        'label'    => 'phrases.confirm-new-password',
                        'name'     => 'new_password_confirmation',
                        'required' => $this->existing_password !== '',
                        'type'     => 'password',
                    ],
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
