<?php

namespace Fuse\Observers;

use Fuse\Models\RolePermission;
use Fuse\Traits\BaseObserver;

class RolePermissionObserver
{
    use BaseObserver;

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
    protected function clearRolePermissionCaches($role_permission): void
    {
        $this->clearCaches($role_permission);
    }
}
