<?php

declare(strict_types=1);

namespace App\Base;

use Illuminate\Support\ServiceProvider;

abstract class SSOServiceProvider extends ServiceProvider
{
    abstract public static function fields(): array;
}
