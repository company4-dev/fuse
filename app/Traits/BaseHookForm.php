<?php

namespace Fuse\Traits;

use Illuminate\Support\Collection;

trait BaseHookForm
{
    abstract public static function fields(array $existing, $form, $component): array;

    abstract public static function process(Collection $validated, $form, $component): bool;
}
