<?php

namespace App\View\Forms\Auth;

use App\Models\User;
use App\Traits\BaseLivewireForm;
use Livewire\Form;

class Register extends Form
{
    use BaseLivewireForm;

    public string $first_name            = '';
    public string $last_name             = '';
    public string $email                 = '';
    public string $password              = '';
    public string $password_confirmation = '';

    public function actions(): array
    {
        return [
            [
                'component' => 'link',
                'label'     => 'phrases.already-registered',
                'route'     => 'login',
            ],
            [
                'component' => 'field',
                'label'     => 'dictionary.register',
                'name'      => 'register',
                'type'      => 'submit',
            ],
        ];
    }

    public function fields(): array
    {
        return [
            [
                'autocomplete' => 'first_name',
                'autofocus'    => true,
                'label'        => 'phrases.first-name',
                'name'         => 'first_name',
                'required'     => true,
                'type'         => 'text',
            ],
            [
                'autocomplete' => 'last_name',
                'label'        => 'phrases.last-name',
                'name'         => 'last_name',
                'required'     => true,
                'type'         => 'text',
            ],
            [
                'autocomplete' => 'email',
                'label'        => 'dictionary.email',
                'name'         => 'email',
                'required'     => true,
                'rules'        => [
                    'unique:'.User::class,
                ],
                'type' => 'email',
            ],
            [
                'autocomplete' => 'new-password',
                'label'        => 'dictionary.password',
                'name'         => 'password',
                'required'     => true,
                'type'         => 'password',
            ],
            [
                'autocomplete' => 'new-password',
                'label'        => 'phrases.confirm-password',
                'name'         => 'password_confirmation',
                'required'     => true,
                'type'         => 'password',
            ],
        ];
    }

    public function setModel($model, object $component): void
    {
    }
}
