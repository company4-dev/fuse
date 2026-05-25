<?php

declare(strict_types=1);

namespace App\View\Tables\Tenants;

use App\Base\Table;
use App\Models\Tenant;

class Tenants extends Table
{
    public const string MODEL = Tenant::class;

    public function actions($model): array
    {
        return [];
    }

    protected function columns(?int $id = null, ?array $dataset = null): array
    {
        return [];
    }

    public function query($query, $id, $filter, $data)
    {
        return $query->orderBy('name');
    }
}
