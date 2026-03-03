<?php

namespace App\View\Tables;

use App\Helpers\Dates;
use App\Models\Role;
use App\Traits\BaseTable;

class Roles
{
    use BaseTable;

    public const string MODEL = Role::class;

    private function actions($model): array
    {
        return [
            [
                'route' => 'management.role',
                'type'  => 'view',
            ],
        ];
    }

    private function columns(?int $id = null, ?array $dataset = null): array
    {
        return [
            'dictionary.name' => [
                'columns' => 'name',
            ],
            'phrases.created-at' => [
                'columns' => 'created_at',
                'value'   => Dates::datetime(...),
            ],
            'phrases.updated-at' => [
                'columns' => 'updated_at',
                'value'   => Dates::datetime(...),
            ],
        ];
    }
}
