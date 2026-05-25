<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Base\Command;

class RunTenantRollbackCommand extends Command
{
    protected $description = 'Runs Tenant rollback migrations';
    protected $signature   = 'jb:run-tenant-rollback';

    public function handle(): void
    {
        $this->call('tenants:rollback');
    }
}
