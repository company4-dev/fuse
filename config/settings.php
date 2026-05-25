<?php

declare(strict_types=1);

return [
    'app' => [
        'name' => config('app.name'),
    ],
    'email' => [
        'sign-off' => "Kind Regards,\r\n{{company_name}}",
    ],
    'formats' => [
        'date'     => 'd/m/Y',
        'datetime' => 1,
        'time'     => 'H:i',
    ],
    'lists' => [
        'chunk-size'     => 100,
        'items-per-page' => 20,
    ],
    'notifications' => [
        'lifetime' => 2_592_000, // 30 days
    ],
    'sso' => [
        'provider' => null,
        'status'   => 0,
    ],
    'security' => [
        'minimum-password-length'   => 8,
        'minimum-password-strength' => 3,
    ],
    'tenancy' => [
        'enabled' => false,
    ],
];
