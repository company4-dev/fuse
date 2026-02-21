<?php

namespace App\View\Tables\Tenants;

use App\Helpers\Dates;
use App\Models\Tenant;
use App\Traits\BaseTable;

class Tenants
{
    use BaseTable;

    public const string MODEL = Tenant::class;

    private function actions($model): array
    {
        return [
            [
                'route' => 'tenants.view',
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

    public function query($query, $id, $filter, $data)
    {
        $query->orderBy('name');
    }
}
