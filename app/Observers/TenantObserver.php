<?php

namespace Fuse\Observers;

use Fuse\Models\Tenant;
use Fuse\Traits\BaseObserver;

class TenantObserver
{
    use BaseObserver;

    public function created(Tenant $tenant): void
    {
        $tenant->log(
            'logs.tenant.created',
            [
                $tenant->name,
            ]
        );
    }

    public function updated(Tenant $tenant): void
    {
        $changes = $this->changes($tenant);
        if ($changes) {
            $tenant->log(
                'logs.tenant.updated',
                [
                    $tenant->name,
                    implode('<br>- ', array_column($changes, 'text')),
                ]
            );
        }
    }

    public function deleted(Tenant $tenant): void
    {
        $tenant->log(
            'logs.tenant.deleted',
            [
                $tenant->name,
            ]
        );
    }

    public function restored(Tenant $tenant): void
    {
        $tenant->log(
            'logs.tenant.restored',
            [
                $tenant->name,
            ]
        );
    }

    public function forceDeleted(Tenant $tenant): void
    {
        $tenant->log(
            'logs.tenant.permanently-deleted',
            [
                $tenant->name,
            ]
        );
    }
}
