<?php

declare(strict_types=1);

namespace App\Hooks;

use App\Base\Hook;
use App\Enums\PlatformHook;

class Icons extends Hook
{
    public static function get(mixed ...$args)
    {
        $return = $args[0];

        foreach (self::getPlatformData(PlatformHook::Icons, include_platform: false) as $icons) {
            foreach ($icons as $key => $value) {
                $return[$key] = $value;
            }
        }

        return $return;
    }
}
