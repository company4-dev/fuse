<?php

declare(strict_types=1);

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
        'exports' => [
            'exporting' => 'Exporting data. You will be notified when the export is complete.',
            'success'   => '":0" Export Ready. Click here to Download.',
        ],
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
