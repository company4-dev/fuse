<?php

namespace Fuse\Helpers;

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

    public static function getVersion()
    {
        return self::init()->version;
    }

    private static function init()
    {
        if (!self::$composer) {
            self::$composer = json_decode(file_get_contents(base_path().'/composer.json'));
        }

        return self::$composer;
    }
}
