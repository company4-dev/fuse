<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Base\Command;

class RunMigrationsCommand extends Command
{
    protected $description = 'Runs migrations';
    protected $signature   = 'jb:run-migrations';

    public function handle(): void
    {
        $this->call('migrate');
        $this->call('tenants:migrate');
    }
}
