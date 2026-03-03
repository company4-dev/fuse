<?php

return [
    'components' => [
        'form' => [
            'file' => [
                'accepts' => 'Accepts :0 files up to :1',
                'heading' => 'Drop files or click to browse',
            ],
        ],
    ],
    'features' => [
        'users' => [
            'base-role' => 'This defines the base role for the user which all other roles extend.',
        ],
    ],
    'pages' => [
        'profile' => [
            'new-password' => 'Leave blank to keep your current password unchanged.',
        ],
    ],
];
