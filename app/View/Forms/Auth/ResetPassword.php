<?php

namespace Fuse\View\Forms\Auth;

use Fuse\Traits\BaseLivewireForm;
use Livewire\Attributes\Locked;
use Livewire\Form;

class ResetPassword extends Form
{
    use BaseLivewireForm;

    public string $email                 = '';
    public string $password              = '';
    public string $password_confirmation = '';

    #[Locked]
    public string $token = '';

    public function actions(): array
    {
        return [
            [
                'component' => 'field',
                'label'     => 'phrases.reset-password',
                'name'      => 'login',
                'type'      => 'submit',
            ],
        ];
    }

    public function fields(): array
    {
        return [
            [
                'autocomplete' => 'email',
                'label'        => 'dictionary.email',
                'name'         => 'email',
                'required'     => true,
                'type'         => 'email',
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
