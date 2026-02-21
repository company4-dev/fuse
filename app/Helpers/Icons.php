<?php

namespace App\Helpers;

use Carbon\Carbon;
use App\Hooks\Icons as HooksIcons;
use Illuminate\Support\Str;

class Icons
{
    public const ICONS = [
        // A
        'add' => 'plus',

        // C
        'category' => 'box-open-full',
        'check'    => 'check',
        'clock'    => 'clock',
        'clock1'   => 'clock-one',
        'clock2'   => 'clock-two',
        'clock3'   => 'clock-three',
        'clock5'   => 'clock-five',
        'clock6'   => 'clock-six',
        'clock7'   => 'clock-seven',
        'clock8'   => 'clock-eight',
        'clock9'   => 'clock-nine',
        'clock10'  => 'clock-ten',
        'clock11'  => 'clock-eleven',
        'clock12'  => 'clock-twelve',

        // D
        'dashboard'   => 'home',
        'date'        => 'calendar-day',
        'delete'      => 'trash',
        'description' => 'align-justify',
        'details'     => 'memo-pad',
        'disk'        => 'hard-drive',

        // E
        'edit' => 'pencil-square',

        // F
        'file' => 'file',

        // I
        'icons' => 'icons',

        // L
        'link' => 'link',
        'list' => 'bars',
        'log'  => 'timeline',

        // M
        'management' => 'cog',
        'money'      => 'money-check-dollar',

        // P
        'parent'      => 'arrow-up',
        'permissions' => 'user-lock',
        'platforms'   => 'layer-plus',

        // R
        'reference' => 'hashtag',
        'role'      => 'user-lock',

        // S
        'schedule' => 'calendar-clock',
        'status'   => 'power',

        // T
        'tenant'  => 'building-office',
        'tenants' => 'building-office-2',
        'timer'   => 'timer',

        // U
        'user'  => 'user',
        'users' => 'users',

        // V
        'version' => 'hashtag',
    ];

    private static $icons = [];

    public function __call($name, $args)
    {
        return $this->get(Str::slug($name));
    }

    public static function __callStatic($name, $args)
    {
        return app(self::class)->$name(...$args);
    }

    public function __construct()
    {
        if (!self::$icons) {
            self::$icons = HooksIcons::get(self::ICONS);
        }
    }

    public function get($type = null)
    {
        if ($type === null) {
            return self::$icons;
        }

        if (array_key_exists($type, self::$icons)) {
            return self::$icons[$type];
        }

        $icon = Str::singular($type);

        if (array_key_exists($icon, self::$icons)) {
            return self::$icons[$icon];
        }

        $icon = Str::plural($type);

        if (array_key_exists($icon, self::$icons)) {
            return self::$icons[$icon];
        }

        return $this->validate_icon($type);
    }

    public function get_icons()
    {
        return self::$icons;
    }

    public static function time(Carbon|int|null|string $time): string
    {
        $icon = null;

        if (is_null($time)) {
            $icon = 'clock';
        } else {
            if (is_string($time)) {
                $time = now()->parse($time);
            }

            $hour = $time->format('g');

            $icon = $hour === '4' ? 'clock' : 'clock'.$hour;
        }

        return app(self::class)->get($icon);
    }

    public function validate_icon($icon)
    {
        if (!array_key_exists($icon, $this->get_icons())) {
            $icon = 'question';
        }

        return $icon;
    }
}
