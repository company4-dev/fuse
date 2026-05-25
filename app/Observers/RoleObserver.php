<?php

declare(strict_types=1);

namespace App\Observers;

use App\Base\Observer;
use App\Models\Role;

class RoleObserver extends Observer
{
    public function created(Role $role): void
    {
        $this->run_created($role, $role->name);
    }

    public function deleted(Role $role): void
    {
        $this->run_deleted($role, $role->name);
    }

    public function forceDeleted(Role $role): void
    {
        $this->run_force_deleted($role, $role->name);
    }

    public function restored(Role $role): void
    {
        $this->run_restored($role, $role->name);
    }

    public function updated(Role $role): void
    {
        $this->run_updated($role, $role->name);
    }
}
