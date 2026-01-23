<?php

namespace Fuse\Console\Commands;

use Fuse\Traits\BaseCommand;
use Illuminate\Console\Command;

class RunMigrationsCommand extends Command
{
    use BaseCommand;

    protected $description = 'Runs migrations';
    protected $signature   = 'jb:run-migrations';

    public function handle()
    {
        $this->call('migrate');
        $this->call('tenants:migrate');
    }
}
