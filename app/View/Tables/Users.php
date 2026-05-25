<?php

declare(strict_types=1);

namespace App\View\Tables;

use App\Base\Table;
use App\Enums\UserStatus;
use App\Helpers\Dates;
use App\Models\Role;
use App\Models\User;

class Users extends Table
{
    public const string MODEL = User::class;

    public function actions($model): array
    {
        return [
            [
                'route' => 'users.view',
                'type'  => 'view',
            ],
        ];
    }

    protected function columns(?int $id = null, ?array $dataset = null): array
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
                'status'  => static fn ($value, $model) => $model->role->table_status ?? [
                    'label' => 'acronyms.na',
                    'color' => 'secondary',
                ],
            ],
            'dictionary.status' => [
                'columns' => 'status_id',
                'status'  => static fn ($value) => $value->details(),
            ],
            'phrases.created-at' => [
                'columns' => 'created_at',
                'value'   => [Dates::class, 'datetime'],
            ],
            'phrases.updated-at' => [
                'columns' => 'updated_at',
                'value'   => [Dates::class, 'datetime'],
            ],
        ];
    }

    public function filters(): array
    {
        return [
            [
                'label'    => 'dictionary.role',
                'modifier' => 'change',
                'multiple' => true,
                'name'     => 'role_id',
                'options'  => Role::pluck('name', 'id')->toArray(),
                'type'     => 'options',
            ],
            [
                'label'    => 'dictionary.status',
                'modifier' => 'change',
                'multiple' => true,
                'name'     => 'status_id',
                'options'  => UserStatus::map(static fn ($item) => $item->detail('label')),
                'type'     => 'options',
            ],
        ];
    }

    public function query($query, $id = null, array $filter = [], ?array $data = [])
    {
        foreach (array_filter($filter) as $field => $value) {
            $query = is_array($value) ? $query->whereIn($field, $value) : $query->where($field, $value);
        }

        return $query;
    }
}
