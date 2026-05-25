<?php

declare(strict_types=1);

namespace App\Observers;

use App\Base\Observer;
use App\Models\RolePermission;
use Illuminate\Database\Eloquent\Model;

class RolePermissionObserver extends Observer
{
    public function created(RolePermission $role_permission): void
    {
        $this->clearRolePermissionCaches($role_permission);
    }

    public function deleted(RolePermission $role_permission): void
    {
        $this->clearRolePermissionCaches($role_permission);
    }

    public function forceDeleted(RolePermission $role_permission): void
    {
        $this->clearRolePermissionCaches($role_permission);
    }

    public function restored(RolePermission $role_permission): void
    {
        $this->clearRolePermissionCaches($role_permission);
    }

    // Helpers
    protected function clearRolePermissionCaches(Model $role_permission): void
    {
        $this->clearCaches($role_permission);
    }
}
