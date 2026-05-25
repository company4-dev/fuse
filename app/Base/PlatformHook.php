<?php

declare(strict_types=1);

namespace App\Base;

abstract class PlatformHook
{
    abstract public static function run($data, $platform = null): array;
}
