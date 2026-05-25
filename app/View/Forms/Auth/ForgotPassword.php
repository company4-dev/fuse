<?php

declare(strict_types=1);

namespace App\View\Forms\Auth;

use App\Base\LivewireForm;

class ForgotPassword extends LivewireForm
{
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

    protected function setModel($model, object $component): void {}
}
