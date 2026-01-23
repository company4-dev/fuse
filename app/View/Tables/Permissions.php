<?php

namespace Fuse\View\Tables;

use Fuse\Models\Permission;
use Fuse\Traits\BaseTable;

class Permissions
{
    use BaseTable;

    public const string MODEL = Permission::class;

    private function actions($model): array
    {
        return [];
    }

    private function columns(?int $id = null, ?array $dataset = null): array
    {
        return [
            'dictionary.permission' => [
                'columns' => 'name',
                'value'   => fn ($value, $model) => ___($model->label.'.label'),
            ],
            'dictionary.description' => [
                'value' => fn ($value, $model) => ___($model->label.'.description'),
            ],
        ];
    }

    public function query($query, $id = null, array $filter = [], ?array $data = [])
    {
        return $query->addSelect('platform')->whereRelation('role_permissions', 'role_id', $id);
    }
}
