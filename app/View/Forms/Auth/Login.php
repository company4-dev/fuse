<?php

declare(strict_types=1);

namespace App\View\Forms\Auth;

use App\Base\LivewireForm;
use Illuminate\Support\Facades\Route;

class Login extends LivewireForm
{
    public mixed $remember  = false;
    public string $email    = '';
    public string $password = '';

    public function actions(): array
    {
        $actions = [];

        if (Route::has('register')) {
            $actions[] = [
                'component' => 'link',
                'label'     => 'dictionary.register',
                'route'     => 'register',
            ];
        }

        $actions[] = [
            'component' => 'field',
            'label'     => 'dictionary.login',
            'name'      => 'login',
            'type'      => 'submit',
        ];

        return $actions;
    }

    public function fields(): array
    {
        $fields = [
            [
                'autocomplete' => 'email',
                'autofocus'    => true,
                'label'        => 'dictionary.email',
                'name'         => 'email',
                'required'     => true,
                'type'         => 'email',
            ],
            [
                'label'    => 'dictionary.password',
                'name'     => 'password',
                'required' => true,
                'type'     => 'password',
            ],
            [
                'label'   => 'phrases.remember-me',
                'name'    => 'remember',
                'options' => [
                    1 => 'dictionary.yes',
                ],
                'type' => 'options',
            ],
        ];

        if (Route::has('password.request')) {
            $fields[] = [
                'href'  => 'password.request',
                'label' => 'phrases.forgot-password',
                'type'  => 'component.link',
            ];
        }

        return $fields;
    }

    protected function setModel($model, object $component): void {}
}
