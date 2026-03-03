<?php

namespace App\Helpers;

use Nwidart\Modules\Facades\Module;
use Nwidart\Modules\Module as LaravelModule;

class Fuses
{
    private static $fuses;

    public static function active(): object
    {
        self::$fuses = Module::getByStatus(1);

        return new self;
    }

    public static function all(): object
    {
        self::$fuses = Module::all();

        return new self;
    }

    public static function each(callable $callback): void
    {
        foreach (self::$fuses as $slug => $fuse) {
            $callback($fuse, $slug);
        }
    }

    public static function find(string $name): ?LaravelModule
    {
        return Module::find($name);
    }

    public static function first(): ?LaravelModule
    {
        return collect(self::$fuses)->first();
    }

    public static function getFromClass(string $class): ?LaravelModule
    {
        [, $class] = array_pad(explode('Fuses\\', $class), 2, null);

        if ($class) {
            [$fuse] = explode('\\', $class);

            return self::find($fuse);
        }

        return null;
    }

    public static function getNameSpace(?string $fuse = null): string
    {
        if ($fuse === null) {
            return 'App\\';
        }

        return '\\Fuses\\'.self::find($fuse)->getStudlyName().'\\';
    }

    public static function isEnabled(string $name): bool
    {
        return Module::isEnabled($name);
    }

    public static function get(): array
    {
        return self::$fuses;
    }

    public static function pluck(string $column_key, ?string $index_key = null): array
    {
        $values = [];

        foreach (self::$fuses as $slug => $fuse) {
            if (method_exists($fuse, 'get'.$column_key)) {
                $key = $index_key === 'slug'
                    ? $slug
                    : (method_exists($fuse, 'get'.$index_key) ? $fuse->{'get'.$column_key}() : null);

                $values[$key] = $fuse->{'get'.$column_key}();
            }
        }

        return $values;
    }

    public static function rawStatuses(): array
    {
        return config('modules.activators');
    }
}
