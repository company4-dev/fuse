<?php

declare(strict_types=1);

namespace App\View\Forms\Management;

// use App\Enums\SSOProvider;
// use App\Enums\SSOStatus;
use App\Base\LivewireForm;

class Settings extends LivewireForm
{
    public array $settings;

    public function actions(): array
    {
        return [
            [
                'component' => 'field',
                'label'     => 'dictionary.save',
                'name'      => 'save',
                'type'      => 'submit',
            ],
        ];
    }

    public function fields(): array
    {
        // if ((int) $this->settings['sso']['status'] !== SSOStatus::Off->value) {
        //     $fields['acronyms.sso'] = array_merge(
        //         $fields['acronyms.sso'],
        //         [
        //             [
        //                 'label'    => 'dictionary.provider',
        //                 'modifier' => 'change',
        //                 'name'     => 'settings.sso.provider',
        //                 'options'  => SSOProvider::map(fn ($provider) => $provider->name),
        //                 'type'     => 'options',
        //             ],
        //         ],
        //     );

        //     if ($this->settings['sso']['provider']) {
        //         $class = SSOProvider::fromName($this->settings['sso']['provider'])->class();

        //         $fields['acronyms.sso'] = array_merge(
        //             $fields['acronyms.sso'],
        //             $class::fields(),
        //         );
        //     }
        // }

        return [
            // 'acronyms.sso' => [
            //     [
            //         'label'    => 'dictionary.status',
            //         'modifier' => 'change',
            //         'name'     => 'settings.sso.status',
            //         'options'  => SSOStatus::map(static fn (SSOStatus $status) => [
            //             'description' => $status->description(),
            //             'label'       => $status->label(),
            //         ]),
            //         'type'  => 'options',
            //         'value' => $this->settings['sso']['status'],
            //     ],
            // ],
            'dictionary.tenancy' => [
                [
                    'label' => 'dictionary.enabled',
                    'name'  => 'settings.tenancy.enabled',
                    'type'  => 'switch',
                    'value' => $this->settings['tenancy']['enabled'],
                ],
            ],
        ];
    }

    public function mount(array $settings): void
    {
        // Include only the settings we're using in the form
        $this->settings = [
            // 'sso'     => $settings['sso'],
            'tenancy' => [
                'enabled' => (bool) $settings['tenancy']['enabled'],
            ],
        ];
    }

    protected function setModel($setting, object $component): void {}
}
