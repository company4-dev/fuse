<?php

namespace App\Console\Commands;

use App\Traits\BaseCommand;
use Illuminate\Console\Command;

class RunTenantRollbackCommand extends Command
{
    use BaseCommand;

    protected $description = 'Runs Tenant rollback migrations';
    protected $signature   = 'jb:run-tenant-rollback';

    public function handle()
    {
        $this->call('tenants:rollback');
    }
}
