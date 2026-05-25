<?php

declare(strict_types=1);

namespace App\Base;

use App\Enums\TenantDisplay;

// Enums can't extend classes, so this must be a trait
trait PermissionsEnum
{
    abstract public function display(): TenantDisplay;

    abstract public function label(): string;

    abstract public function fixed(): bool;

    abstract public function group(): string;
}
