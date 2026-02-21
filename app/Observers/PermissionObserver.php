<?php

namespace App\Observers;

use App\Models\Permission;
use App\Traits\BaseObserver;

class PermissionObserver
{
    use BaseObserver;

    public function created(Permission $permission): void
    {
        $permission->log(
            'logs.permission.created',
            [
                $permission->name,
            ]
        );
    }

    public function updated(Permission $permission): void
    {
        $changes = $this->changes($permission);
        if ($changes) {
            $permission->log(
                'logs.permission.updated',
                [
                    $permission->name,
                    '- '.implode('<br>- ', array_column($changes, 'text')),
                ]
            );
        }
    }

    public function deleted(Permission $permission): void
    {
        $permission->log(
            'logs.permission.deleted',
            [
                $permission->name,
            ]
        );
    }

    public function restored(Permission $permission): void
    {
        $permission->log(
            'logs.permission.restored',
            [
                $permission->name,
            ]
        );
    }

    public function forceDeleted(Permission $permission): void
    {
        $permission->log(
            'logs.permission.permanently-deleted',
            [
                $permission->name,
            ]
        );
    }
}
