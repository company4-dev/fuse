<?php

namespace App\Hooks;

use App\Enums\FuseHook;
use App\Traits\BaseHook;
use Illuminate\Support\Arr;

class AuthMessages
{
    use BaseHook;

    public static function get(mixed ...$args)
    {
        $default_quotes = null;
        $quotes         = [];

        $default_quotes = [
            '&ldquo;Hi There! My name is Rolo. I have just met you, and I love you.&rdquo;',
            '&ldquo;I can smell you!&rdquo;',
            '&ldquo;I do not like the cone of shame.&rdquo;',
            '&ldquo;Squirrel!&rdquo;',
        ];

        foreach (self::getFuseData(FuseHook::AuthMessages, include_fuse: false) as $fuse_quotes) {
            $quotes = array_merge($quotes, $fuse_quotes);
        }

        if (!$quotes) {
            $quotes = $default_quotes;
        }

        Arr::shuffle($quotes);

        return $quotes[0];
    }
}
