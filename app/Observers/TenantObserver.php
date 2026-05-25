<?php

declare(strict_types=1);

namespace App\Observers;

use App\Base\Observer;
use App\Models\Tenant;

class TenantObserver extends Observer
{
    public function created(Tenant $tenant): void
    {
        $this->run_created($tenant, $tenant->name);
    }

    public function deleted(Tenant $tenant): void
    {
        $this->run_deleted($tenant, $tenant->name);
    }

    public function forceDeleted(Tenant $tenant): void
    {
        $this->run_force_deleted($tenant, $tenant->name);
    }

    public function restored(Tenant $tenant): void
    {
        $this->run_restored($tenant, $tenant->name);
    }

    public function updated(Tenant $tenant): void
    {
        $this->run_updated($tenant, $tenant->name);
    }
}
