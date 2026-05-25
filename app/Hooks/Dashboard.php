<?php

declare(strict_types=1);

namespace App\Hooks;

use App\Base\Hook;
use App\Enums\PlatformHook;

class Dashboard extends Hook
{
    public static function get(mixed ...$args): array|bool
    {
        $return = [];

        [$what] = array_pad($args, 1, null);

        foreach (self::getPlatformData(PlatformHook::Dashboard, include_platform: false) as $items) {
            $return = array_merge($return, $items);
        }

        return $return;
    }
}
