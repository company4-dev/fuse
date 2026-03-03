<?php

namespace App\Traits;

use App\Enums\TenantDisplay;

trait BasePermissionsEnum
{
    abstract public function display(): TenantDisplay;

    abstract public function label(): string;

    abstract public function fixed(): bool;

    abstract public function group(): string;
}
