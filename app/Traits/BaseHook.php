<?php

namespace App\Traits;

use App\Enums\FuseHook;
use App\Helpers\Formatters;
use App\Helpers\Fuses;
use InvalidArgumentException;
use ReflectionClass;

trait BaseHook
{
    abstract public static function get(mixed ...$args);

    private static function getFuseData(FuseHook $hook, $data = null, bool $include_fuse = true): array
    {
        $data      = [];
        $fuses = Fuses::active();

        if (!$fuses) {
            return $data;
        }

        $fuses->each(function ($fuse, $slug) use (&$data, $hook, $include_fuse) {
            $class = 'Fuses\\'.$fuse->getName().'\\Hooks\\'.$hook->name;

            if (class_exists($class)) {
                if ($include_fuse) {
                    $data[$slug] = [
                        'data'     => $class::run($data, $fuse),
                        'fuse' => $fuse,
                    ];
                } else {
                    $data[$slug] = $class::run($data, $fuse);
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
