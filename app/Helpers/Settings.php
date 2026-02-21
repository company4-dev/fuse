<?php

namespace App\Helpers;

use Exception;
use App\Models\Setting;

class Settings
{
    public static function get(array $settings, $snake_keys = false)
    {
        $return = [];
        $config = collect(config('settings'))->dot();

        if (is_array($settings[0])) {
            $settings = $settings[0];
        }

        foreach ($settings as $key => $value) {
            if (is_numeric($key)) {
                $cast    = null;
                $setting = $value;
            } else {
                $cast    = $value;
                $setting = $key;
            }

            if (!$config->offsetExists($setting)) {
                throw new Exception('Setting "'.$setting.'" not found in config.');
            }

            $key   = $snake_keys ? str_replace('-', '_', $setting) : $setting;
            $value = $config[$setting];

            if ($cast) {
                settype($value, $cast);
            }

            $return[$key] = $value;
        }

        return collect($return);
    }

    public static function load()
    {
        $formatted = Cache::forever('jellybean', 'settings', 1, function () {
            $defaults  = Config('settings');
            $formatted = Setting::formatted();

            foreach ($defaults as $group => $settings) {
                if (!array_key_exists($group, $formatted)) {
                    $formatted[$group] = [];
                }

                foreach ($settings as $key => $value) {
                    if (!array_key_exists($key, $formatted[$group])) {
                        $formatted[$group][$key] = $value;
                    }
                }
            }

            return $formatted;
        });

        // Update tenant migrations paths
        $migration_parameters             = config('tenancy.migration_parameters');
        $migration_parameters['--path'][] = base_path('database/migrations/tenant');

        // foreach (Platforms::active()->get() as $platform) {
        //     $migration_parameters['--path'][] = $platform->getPath().'/database/migrations/tenant';
        // }

        config([
            // 'app.name' => Cache::forever(
            //     'jellybean',
            //     'platform.name',
            //     1,
            //     function () {
            //         $base_platform = Platforms::active()->first();

            //         return $base_platform ? config($base_platform->getLowerName())['name'] : config('app.name');
            //     }
            // ),
            'settings'                     => $formatted,
            'tenancy.migration_parameters' => $migration_parameters,
        ]);
    }
}
