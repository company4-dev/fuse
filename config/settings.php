<?php

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
        'items-per-page' => 20,
    ],
    'security' => [
        'minimum-password-length'   => 8,
        'minimum-password-strength' => 3,
    ],
];
