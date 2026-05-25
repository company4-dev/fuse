<?php

declare(strict_types=1);

namespace App\Base;

use App\Enums\PlatformHook;
use App\Helpers\Formatters;
use App\Helpers\Platforms;
use InvalidArgumentException;
use ReflectionClass;

abstract class Hook
{
    abstract public static function get(mixed ...$args);

    protected static function getPlatformData(PlatformHook $hook, $data = null, bool $include_platform = true): array
    {
        $platforms = Platforms::active();
        $return    = [];

        if (!$platforms) {
            return $return;
        }

        $platforms->each(static function ($platform, $slug) use (&$data, $hook, $include_platform, &$return): void {
            $class = 'Platforms\\'.$platform->getName().'\\Hooks\\'.$hook->name;

            if (class_exists($class)) {
                if ($include_platform) {
                    $return[$slug] = [
                        'data'     => $class::run($data, $platform),
                        'platform' => $platform,
                    ];
                } else {
                    $return[$slug] = $class::run($data, $platform);
                }
            }
        });

        return $return;
    }

    protected static function validateAction(?int $action = null, bool $allow_null = false): void
    {
        $class     = new ReflectionClass(static::class);
        $constants = $class->getConstants();

        if ($allow_null && $action === null) {
            return;
        }

        if (!in_array($action, $constants, true)) {
            throw new InvalidArgumentException(___(
                'errors.exceptions.hooks.base.invalid-type',
                [
                    Formatters::implode('", "', '" or "', array_keys($constants)),
                ]
            ));
        }
    }
}
