<?php

namespace Fuse\View\Tables\Tenants;

use Fuse\Helpers\Dates;
use Fuse\Models\Domain as DomainModel;
use Fuse\Traits\BaseTable;

class Domains
{
    use BaseTable;

    public const string MODEL = DomainModel::class;

    private function actions($model): array
    {
        return [
            [
                'href'   => $model->url,
                'label'  => 'dictionary.visit',
                'target' => '_blank',
                'type'   => 'view',
            ],
        ];
    }

    private function columns(?int $id = null, ?array $dataset = null): array
    {
        return [
            'dictionary.domain' => [
                'columns' => 'domain',
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
        $query->where('tenant_id', $id);
    }
}
