<?php

declare(strict_types=1);

namespace App\View\Tables;

use App\Base\Table;
use App\Models\Permission;

class Permissions extends Table
{
    public const string MODEL = Permission::class;

    public function actions($model): array
    {
        return [];
    }

    protected function columns(?int $id = null, ?array $dataset = null): array
    {
        return [];
    }

    public function query($query, $id = null, array $filter = [], ?array $data = [])
    {
        return $query->addSelect('platform')->whereRelation('role_permissions', 'role_id', $id);
    }
}
