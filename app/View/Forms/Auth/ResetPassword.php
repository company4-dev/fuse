<?php

declare(strict_types=1);

namespace App\View\Forms\Auth;

use App\Base\LivewireForm;
use Livewire\Attributes\Locked;

class ResetPassword extends LivewireForm
{
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

    protected function setModel($model, object $component): void {}
}
