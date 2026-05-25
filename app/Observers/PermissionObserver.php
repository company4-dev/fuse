<?php

declare(strict_types=1);

namespace App\Observers;

use App\Base\Observer;
use App\Models\Permission;

class PermissionObserver extends Observer
{
    public function created(Permission $permission): void
    {
        $this->run_created($permission, $permission->name);
    }

    public function deleted(Permission $permission): void
    {
        $this->run_deleted($permission, $permission->name);
    }

    public function forceDeleted(Permission $permission): void
    {
        $this->run_force_deleted($permission, $permission->name);
    }

    public function restored(Permission $permission): void
    {
        $this->run_restored($permission, $permission->name);
    }

    public function updated(Permission $permission): void
    {
        $this->run_updated($permission, $permission->name);
    }
}
