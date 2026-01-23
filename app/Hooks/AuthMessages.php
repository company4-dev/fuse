<?php

namespace Fuse\Hooks;

use Fuse\Enums\PlatformHook;
use Fuse\Traits\BaseHook;
use Illuminate\Support\Arr;

class AuthMessages
{
    use BaseHook;

    public static function get(mixed ...$args)
    {
        $default_quotes = null;
        $quotes         = [];

        $default_quotes = [
            '&ldquo;Hi There! My name is Sheldon. I have just met you, and I love you.&rdquo;',
            '&ldquo;I can smell you!&rdquo;',
            '&ldquo;I do not like the cone of shame.&rdquo;',
            '&ldquo;Squirrel!&rdquo;',
        ];

        foreach (self::getPlatformData(PlatformHook::AuthMessages, include_platform: false) as $platform_quotes) {
            $quotes = array_merge($quotes, $platform_quotes);
        }

        if (!$quotes) {
            $quotes = $default_quotes;
        }

        Arr::shuffle($quotes);

        return $quotes[0];
    }
}
