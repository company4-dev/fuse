<?php

namespace App\View\Tables;

use App\Enums\UserStatus;
use App\Helpers\Dates;
use App\Models\Role;
use App\Models\User;
use App\Traits\BaseTable;

class Users
{
    use BaseTable;

    public const string MODEL = User::class;

    private function actions($model): array
    {
        return [
            [
                'route' => 'users.view',
                'type'  => 'view',
            ],
        ];
    }

    private function columns(?int $id = null, ?array $dataset = null): array
    {
        return [
            'dictionary.name' => [
                'columns' => [
                    'first_name',
                    'last_name',
                ],
            ],
            'dictionary.role' => [
                'columns' => 'role_id',
                'status'  => fn ($value, $model) => $model->role?->table_status ?? [
                    'label' => 'acronyms.na',
                    'color' => 'secondary',
                ],
            ],
            'dictionary.status' => [
                'columns' => 'status_id',
                'status'  => fn ($value) => $value->details(),
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

    public function filters(): array
    {
        return [
            [
                'label'    => 'dictionary.role',
                'modifier' => 'change',
                'name'     => 'role_id',
                'options'  => Role::pluck('name', 'id')->toArray(),
                'type'     => 'options',
            ],
            [
                'label'    => 'dictionary.status',
                'modifier' => 'change',
                'name'     => 'status_id',
                'options'  => UserStatus::map(fn ($item) => $item->detail('label')),
                'type'     => 'options',
            ],
        ];
    }

    public function query($query, $id = null, array $filter = [], ?array $data = [])
    {
        return $query->where($filter);
    }
}
