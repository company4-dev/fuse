<?php

declare(strict_types=1);

namespace App\View\Tables\Tenants;

use App\Base\Table;
use App\Models\Domain as DomainModel;

class Domains extends Table
{
    public const string MODEL = DomainModel::class;

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
        return $query->where('tenant_id', $id);
    }
}
