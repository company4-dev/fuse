<?php

declare(strict_types=1);

return [
    'sso' => [
        'status' => [
            'off'      => 'Users can only log in with local accounts.',
            'optional' => 'Users can login with local and SSO accounts.',
            'forced'   => 'Users can only login with SSO accounts.',
        ],
    ],
];
