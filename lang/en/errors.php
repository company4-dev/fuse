<?php

declare(strict_types=1);

return [
    // Errors #001 - 199: Authentication
    'auth' => [
        'failed'   => 'Error #001: These credentials do not match our records.',
        'password' => 'Error #002: The provided password is incorrect.',
        'throttle' => 'Error #003: Too many login attempts. Please try again in :seconds seconds.',
    ],
    // Errors #100 - 1999: Exceptions
    'exceptions' => [
        'components' => [
            // Errors #100 - 199: Components > Button
            'button' => [
                'attribute-required' => 'Error #100: `:0` is required.',
                'invalid-type'       => 'Error #101: Input type `:0` does not exist.',
            ],
            // Errors #200 - 299: Components > Form
            'form' => [
                'invalid-action'         => 'Error #200: Action component `:0` is not supported.',
                'invalid-action-type'    => 'Error #201: Action type `:0` does not exist.',
                'invalid-attribute-type' => 'Error #202: `:0` attribute is not valid for field ":1".',
                'invalid-input'          => 'Error #203: Input type `:0` does not exist',
                'invalid-max'            => 'Error #204: `max` attribute must be an integer for field ":0".',
                'invalid-min'            => 'Error #205: `min` attribute must be an integer for field ":0".',
                'invalid-modifier'       => 'Error #212: `modifier` attribute must be `:0` for field ":1".',
                'invalid-multiple'       => 'Error #206: `multiple` attribute must be a boolean for field ":0".',
                'invalid-rules'          => 'Error #208: `rules` attribute must be an array.',
                'invalid-step'           => 'Error #209: `step` attribute must be a "any" or numerical for field ":0".',
                'invalid-type'           => 'Error #211: Form type `:0` does not exist within ":1".',
                'invalid-variant'        => 'Error #210: Invalid variant provided for input field.',
                'invalid-wire-attribute' => 'Error #213: Invalid wire key/key prefix `:0` provided for input field
                    ":1".',
                'missing-property' => 'Error #307: `public [type] $:0` is missing from the properties of `:1`.',
            ],
            // Errors #300 - 399: Components > Input
            'input' => [
                'attribute-required' => 'Error #300: `:0` is required for field ":1".',
                'invalid-attribute'  => 'Error #301: Invalid attribute `:0` provided for field ":1".',
                'invalid-required'   => 'Error #302: `required` attribute must be a boolean for field ":0".',
                'invalid-type'       => 'Error #303: Input type `:0` does not exist.',
                'options-required'   => 'Error #304: Options attribute is required for field ":0".',
            ],
            // Errors #400 - 499: Components > Tab
            'tab' => [
                'invalid-tab' => 'Error #400: Tab target is not within the `tabs` attribute that was passed to the tabs
                    component.',
            ],
            // Errors #500 - 599: Components > Table
            'table' => [
                'invalid-column-value-callback' => 'Error #500: Callback for column ":0" should be passed as an array of
                    `[Class::class, \'method\']`.',
            ],
        ],
        'hooks' => [
            // Errors #600 - 699: Hooks > BaseHook
            'base' => [
                'invalid-type' => 'Error #600 Invalid `$type` provided for hook seeder. Expected ":0".',
            ],
            // Errors #700 - 799: Hooks > Seeder
            'seeder' => [
                'invalid-data' => 'Error #700: Seeder hook expects an array with keys "core" and/or "tenant".',
            ],
            // Errors #800 - 899: Hooks > Seeder
            'permissions' => [
                'invalid-name'    => 'Error #800: Permission `:0` should be `:1`.',
                'missing-display' => 'Error #801: The `display` attribute for platform :0 is required and should be an
                    instance of :1.',
            ],
        ],
        'layouts' => [
            // Errors #900 - 999: Layouts > Menu
            'menu' => [
                ''                => 'Error #900: ',
                'missing-display' => 'Error #901: The `display` attribute for platform :0 is required and should be an
                    instance of :1.',
                'missing-route' => 'Error #902: Either a `modal`, `route` or `wire:click` attribute for ":0" is
                    required.',
            ],
        ],
        'models' => [
            // Errors #1000 - 1099: Models > File
            'file' => [
                'invalid-size' => 'Error #1000: Invalid size provided, size should be one of ":0"',
            ],
        ],
        'traits' => [
            // Errors #1100 - 1199: Traits > Model
            'model' => [
                'invalid-search-fields' => 'Error #1100: The `$search_fields` property `$search_fields` is not an
                    array.',
                'no-search-fields' => 'Error #1101: The `$fields` attribute is `null` and `:0` does not have any
                    searchable fields defined in the protected property `$search_fields`.',
            ],
        ],
    ],
    // Errors #2000 - 2999: Form
    'form' => [
        'submit' => 'Error #300: Could not submit the form due to the following errors:',
    ],
];
