<?php

namespace Fuse\Hooks;

use Fuse\Enums\PlatformHook;
use Fuse\Traits\BaseHook;

class Icons
{
    use BaseHook;

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
