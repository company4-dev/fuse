<?php

declare(strict_types=1);

namespace App\Base;

use Illuminate\Support\Collection;

abstract class HookForm
{
    abstract public static function fields(array $existing, $form, $component): array;

    abstract public static function process(Collection $validated, $form, $component): bool;
}
