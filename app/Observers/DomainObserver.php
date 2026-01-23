<?php

namespace Fuse\Observers;

use Fuse\Models\Domain;
use Fuse\Traits\BaseObserver;

class DomainObserver
{
    use BaseObserver;

    public function created(Domain $domain): void
    {
        $domain->log(
            'logs.domain.created',
            [
                $domain->domain,
            ]
        );
    }

    public function updated(Domain $domain): void
    {
        $changes = $this->changes($domain);
        if ($changes) {
            $domain->log(
                'logs.domain.updated',
                [
                    $domain->domain,
                    '- '.implode('<br>- ', array_column($changes, 'text')),
                ]
            );
        }
    }

    public function deleted(Domain $domain): void
    {
        $domain->log(
            'logs.domain.deleted',
            [
                $domain->domain,
            ]
        );
    }

    public function restored(Domain $domain): void
    {
        $domain->log(
            'logs.domain.restored',
            [
                $domain->domain,
            ]
        );
    }

    public function forceDeleted(Domain $domain): void
    {
        $domain->log(
            'logs.domain.permanently-deleted',
            [
                $domain->domain,
            ]
        );
    }
}
