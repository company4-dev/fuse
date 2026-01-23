<?php

namespace Fuse\Traits;

use Fuse\Enums\PlatformHook;
use Fuse\Helpers\Formatters;
use Fuse\Helpers\Platforms;
use InvalidArgumentException;
use ReflectionClass;

trait BaseHook
{
    abstract public static function get(mixed ...$args);

    private static function getPlatformData(PlatformHook $hook, $data = null, bool $include_platform = true): array
    {
        $data      = [];
        $platforms = Platforms::active();

        if (!$platforms) {
            return $data;
        }

        $platforms->each(function ($platform, $slug) use (&$data, $hook, $include_platform) {
            $class = 'Platforms\\'.$platform->getName().'\\Hooks\\'.$hook->name;

            if (class_exists($class)) {
                if ($include_platform) {
                    $data[$slug] = [
                        'data'     => $class::run($data, $platform),
                        'platform' => $platform,
                    ];
                } else {
                    $data[$slug] = $class::run($data, $platform);
                }
            }
        });

        return $data;
    }

    private static function validateAction(?int $action = null, bool $allow_null = false): void
    {
        $class     = new ReflectionClass(self::class);
        $constants = $class->getConstants();

        if ($allow_null && $action === null) {
            return;
        }

        if (!in_array($action, $constants)) {
            throw new InvalidArgumentException(___(
                'errors.exceptions.hooks.base.invalid-type',
                [
                    Formatters::implode('", "', '" or "', array_keys($constants)),
                ]
            ));
        }
    }
}
