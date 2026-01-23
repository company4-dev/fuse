<?php

namespace Fuse\Helpers;

use Nwidart\Modules\Facades\Module;
use Nwidart\Modules\Module as LaravelModule;

class Platforms
{
    private static $platforms;

    public static function active(): object
    {
        self::$platforms = Module::getByStatus(1);

        return new self;
    }

    public static function all(): object
    {
        self::$platforms = Module::all();

        return new self;
    }

    public static function each(callable $callback): void
    {
        foreach (self::$platforms as $slug => $platform) {
            $callback($platform, $slug);
        }
    }

    public static function find(string $name): ?LaravelModule
    {
        return Module::find($name);
    }

    public static function first(): ?LaravelModule
    {
        return collect(self::$platforms)->first();
    }

    public static function getFromClass(string $class): ?LaravelModule
    {
        [, $class] = array_pad(explode('Platforms\\', $class), 2, null);

        if ($class) {
            [$platform] = explode('\\', $class);

            return self::find($platform);
        }

        return null;
    }

    public static function getNameSpace(?string $platform = null): string
    {
        if ($platform === null) {
            return 'Fuse\\';
        }

        return '\\Platforms\\'.self::find($platform)->getStudlyName().'\\';
    }

    public static function isEnabled(string $name): bool
    {
        return Module::isEnabled($name);
    }

    public static function get(): array
    {
        return self::$platforms;
    }

    public static function pluck(string $column_key, ?string $index_key = null): array
    {
        $values = [];

        foreach (self::$platforms as $slug => $platform) {
            if (method_exists($platform, 'get'.$column_key)) {
                $key = $index_key === 'slug'
                    ? $slug
                    : (method_exists($platform, 'get'.$index_key) ? $platform->{'get'.$column_key}() : null);

                $values[$key] = $platform->{'get'.$column_key}();
            }
        }

        return $values;
    }

    public static function rawStatuses(): array
    {
        return config('modules.activators');
    }
}
