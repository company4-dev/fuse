<?php

namespace App\View\Forms\Auth;

use App\Traits\BaseLivewireForm;
use Livewire\Form;

class ForgotPassword extends Form
{
    use BaseLivewireForm;

    public string $email = '';

    public function actions(): array
    {
        return [
            [
                'component' => 'link',
                'label'     => 'phrases.back-to-login',
                'route'     => 'login',
            ],
            [
                'component' => 'field',
                'label'     => 'auth.email-link',
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
                'autofocus'    => true,
                'label'        => 'dictionary.email',
                'name'         => 'email',
                'required'     => true,
                'type'         => 'email',
            ],
        ];
    }

    public function setModel($model, object $component): void
    {
    }
}
