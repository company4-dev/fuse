<?php

namespace Fuse\Helpers;

use Fuse\Hooks\Permissions as HooksPermissions;

class Permissions
{
    private static $permissions = [];

    // public function __call($name, $args)
    // {
    //     return $this->get(Str::slug($name));
    // }

    // public static function __callStatic($name, $args)
    // {
    //     return app(self::class)->$name(...$args);
    // }

    public function __construct()
    {
        self::initPermissions();
    }

    public static function all()
    {
        self::initPermissions();

        return self::$permissions;
    }

    // public function get($type = null)
    // {
    //     if ($type === null) {
    //         return self::$permissions;
    //     }

    //     if (array_key_exists($type, self::$permissions)) {
    //         return self::$permissions[$type];
    //     }

    //     $icon = Str::singular($type);

    //     if (array_key_exists($icon, self::$permissions)) {
    //         return self::$permissions[$icon];
    //     }

    //     $icon = Str::plural($type);

    //     if (array_key_exists($icon, self::$permissions)) {
    //         return self::$permissions[$icon];
    //     }
    // }

    private static function initPermissions()
    {
        if (!self::$permissions) {
            self::$permissions = HooksPermissions::get();
        }
    }
}
