<?php

namespace App\Hooks;

use App\Enums\FuseHook;
use App\Traits\BaseHook;

class Icons
{
    use BaseHook;

    public static function get(mixed ...$args)
    {
        $return = $args[0];

        foreach (self::getFuseData(FuseHook::Icons, include_fuse: false) as $icons) {
            foreach ($icons as $key => $value) {
                $return[$key] = $value;
            }
        }

        return $return;
    }
}
