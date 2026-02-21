<?php

namespace App\Observers;

use App\Models\Role;
use App\Traits\BaseObserver;

class RoleObserver
{
    use BaseObserver;

    public function created(Role $role): void
    {
        $role->log(
            'logs.role.created',
            [
                $role->name,
            ]
        );
    }

    public function updated(Role $role): void
    {
        $changes = $this->changes($role);
        if ($changes) {
            $role->log(
                'logs.role.updated',
                [
                    $role->name,
                    '- '.implode('<br>- ', array_column($changes, 'text')),
                ]
            );
        }
    }

    public function deleted(Role $role): void
    {
        $role->log(
            'logs.role.deleted',
            [
                $role->name,
            ]
        );
    }

    public function restored(Role $role): void
    {
        $role->log(
            'logs.role.restored',
            [
                $role->name,
            ]
        );
    }

    public function forceDeleted(Role $role): void
    {
        $role->log(
            'logs.role.permanently-deleted',
            [
                $role->name,
            ]
        );
    }
}
