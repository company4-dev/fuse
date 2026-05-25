<?php

declare(strict_types=1);

namespace App\Helpers;

class Composer
{
    private static $composer;

    public static function getDescription()
    {
        return self::init()->description;
    }

    public static function getRepository()
    {
        return self::init()->name;
    }

    private static function init()
    {
        if (!self::$composer) {
            self::$composer = json_decode(file_get_contents(base_path().'/composer.json'));
        }

        return self::$composer;
    }
}
