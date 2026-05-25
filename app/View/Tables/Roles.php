<?php

declare(strict_types=1);

namespace App\View\Tables;

use App\Base\Table;
use App\Models\Role;

class Roles extends Table
{
    public const string MODEL = Role::class;

    public function actions($model): ?array
    {
        return [];
    }

    protected function columns(?int $id = null, ?array $dataset = null): array
    {
        return [];
    }
}
