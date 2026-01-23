<?php

return [
    // Errors #1000 - 1999: Authentication
    'auth' => [
        'failed'   => 'Error #1000: These credentials do not match our records.',
        'password' => 'Error #1001: The provided password is incorrect.',
        'throttle' => 'Error #1002: Too many login attempts. Please try again in :seconds seconds.',
    ],
    // Errors #2100 - 2999: Exceptions
    'exceptions' => [
        'components' => [
            // Errors #2100 - 2199: Components > Button
            'button' => [
                'attribute-required' => 'Error #2100: `:0` is required.',
                'invalid-type'       => 'Error #2101: Input type `:0` does not exist.',
            ],
            // Errors #2200 - 2299: Components > Form
            'form' => [
                'invalid-action'         => 'Error #2200: Action component `:0` is not supported.',
                'invalid-action-type'    => 'Error #2201: Action type `:0` does not exist.',
                'invalid-attribute-type' => 'Error #2202: `:0` attribute is not valid for field ":1".',
                'invalid-input'          => 'Error #2203: Input type `:0` does not exist',
                'invalid-max'            => 'Error #2204: `max` attribute must be an integer for field ":0".',
                'invalid-min'            => 'Error #2205: `min` attribute must be an integer for field ":0".',
                'invalid-modifier'       => 'Error #2212: `modifier` attribute must be `:0` for field ":1".',
                'invalid-multiple'       => 'Error #2206: `multiple` attribute must be a boolean for field ":0".',
                'invalid-options'        => 'Error #2207: `options` attribute must be an array.',
                'invalid-rules'          => 'Error #2208: `rules` attribute must be an array.',
                'invalid-step'           => 'Error #2209: `step` attribute must be a "any" or numerical for field ":0".',
                'invalid-type'           => 'Error #2211: Form type `:0` does not exist within ":1".',
                'invalid-variant'        => 'Error #2210: Invalid variant provided for input field.',
                'invalid-wire-attribute' => 'Error #2213: Invalid wire key/key prefix `:0` provided for input field ":1".',
            ],
            // Errors #2300 - 2399: Components > Input
            'input' => [
                'attribute-required' => 'Error #2300: `:0` is required for field ":1".',
                'invalid-attribute'  => 'Error #2301: Invalid attribute `:0` provided for field ":1".',
                'invalid-required'   => 'Error #2302: `required` attribute must be a boolean for field ":0".',
                'invalid-type'       => 'Error #2303: Input type `:0` does not exist.',
                'options-required'   => 'Error #2304: Options attribute is required for field ":0".',
            ],
            // Errors #2400 - 2499: Components > Tab
            'tab' => [
                'invalid-tab' => 'Error #2400: Tab target is not within the `tabs` attribute that was passed to the tabs component.',
            ],
        ],
        'hooks' => [
            // Errors #2500 - 2599: Hooks > BaseHook
            'base' => [
                'invalid-type' => 'Error #2500 Invalid `$type` provided for hook seeder. Expected ":0".',
            ],
            // Errors #2600 - 2699: Hooks > Seeder
            'seeder' => [
                'invalid-data' => 'Error #2600: Seeder hook expects an array with keys "core" and/or "tenant".',
            ],
            // Errors #2700 - 2799: Hooks > Seeder
            'permissions' => [
                'invalid-name'    => 'Error #2700: Permission `:0` should be `:1`.',
                'missing-display' => 'Error #2701: The `display` attribute for platform :0 is required and should be an instance of '
                    .':1.',
            ],
        ],
        'layouts' => [
            // Errors #2600 - 2699: Layouts > Menu
            'menu' => [
                ''                => 'Error #2600: ',
                'missing-display' => 'Error #2601: The `display` attribute for platform :0 is required and should be an instance of '
                    .':1.',
                'missing-route' => 'Error #2602: Either a `route` or `wire:click` attribute for ":0" is required.',
            ],
        ],
        'traits' => [
            // Errors #2700 - 2799: Traits > Model
            'model' => [
                'invalid-search-fields' => 'Error #2700: The `$search_fields` property `$search_fields` is not an array.',
                'no-search-fields'      => 'Error #2701: The `$fields` attribute is `null` and `:0` does not have any searchable '
                    .'fields defined in the protected property `$search_fields`.',
            ],
        ],
    ],
    // Errors #3000 - 3999: Form
    'form' => [
        'submit' => 'Error #300: Could not submit the form due to the following errors:',
    ],
];
