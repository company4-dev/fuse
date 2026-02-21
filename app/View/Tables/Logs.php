<?php

namespace App\View\Tables;

use App\Helpers\Dates;
use App\Models\Activity;
use App\Models\User;
use App\Traits\BaseTable;
use Illuminate\Support\Facades\DB;

class Logs
{
    use BaseTable;

    public const string MODEL = Activity::class;

    private function actions($model): array
    {
        $actions = [];
        $route   = $model->subject->route;

        if ($route && (is_array($route) ? $route[0] !== 'users.view' : $route !== 'users.view')) {
            $actions[] = [
                'id'    => $model->subject->id,
                'label' => 'dictionary.context',
                'route' => $route,
                'type'  => 'view',
            ];
        }

        if ($model->causer) {
            $actions[] = [
                'id'    => $model->causer_id,
                'label' => 'dictionary.user',
                'route' => 'users.view',
                'type'  => 'view',
            ];
        }

        return $actions;
    }

    private function columns(?int $id = null, ?array $dataset = null): array
    {
        return [
            'dictionary.date' => [
                'columns' => 'created_at',
                'value'   => Dates::datetime(...),
            ],
            'dictionary.description' => [
                'columns' => [
                    'description',
                ],
            ],
            'dictionary.user' => [
                'value' => fn ($value, $model) => $model->causer ? $model->causer->name : null,
            ],
        ];
    }

    public function filters(): array
    {
        $users = User
            ::select('first_name', 'id', 'last_name')
            ->whereIn('id', Activity::where('causer_type', User::class)->pluck('causer_id'))
            ->get()
            ->mapWithKeys(fn ($item) => [$item->id => $item->name])
            ->toArray();

        return [
            [
                'label'    => 'dictionary.date',
                'modifier' => 'change',
                'name'     => 'dates',
                'type'     => 'date-range',
            ],
            [
                'label'    => 'dictionary.user',
                'modifier' => 'change',
                'multiple' => true,
                'name'     => 'user_ids',
                'options'  => $users,
                'type'     => 'options',
            ],
        ];
    }

    public function query($query, $id = null, array $filter = [], ?array $data = [])
    {
        return $query
            ->addSelect([
                'causer_id',
                'causer_type',
                'properties',
                'subject_id',
                'subject_type',
            ])
            ->when(
                $filter['dates'] ?? false,
                fn ($query) => $query->whereBetween(
                    DB::Raw('DATE(`created_at`)'),
                    [
                        $filter['dates']['start'],
                        $filter['dates']['end'],
                    ]
                )
            )
            ->when(
                $filter['user_ids'] ?? false,
                fn ($query) => $query
                    ->where('causer_type', User::class)
                    ->whereIn('causer_id', $filter['user_ids'])
            )
            ->with([
                'causer',
                'subject',
            ]);
    }
}
