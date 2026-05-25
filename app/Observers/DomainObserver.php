<?php

declare(strict_types=1);

namespace App\Observers;

use App\Base\Observer;
use App\Models\Domain;

class DomainObserver extends Observer
{
    public function created(Domain $domain): void
    {
        $this->run_created($domain, $domain->domain);
    }

    public function deleted(Domain $domain): void
    {
        $this->run_deleted($domain, $domain->domain);
    }

    public function forceDeleted(Domain $domain): void
    {
        $this->run_force_deleted($domain, $domain->domain);
    }

    public function restored(Domain $domain): void
    {
        $this->run_restored($domain, $domain->domain);
    }

    public function updated(Domain $domain): void
    {
        $this->run_updated($domain, $domain->domain);
    }
}
