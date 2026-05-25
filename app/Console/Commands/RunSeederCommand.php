<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Base\Command;

class RunSeederCommand extends Command
{
    protected $description = 'Runs database seeders';
    protected $signature   = 'jb:run-seeders';

    public function handle(): void
    {
        $this->call('db:seed');
        $this->call('tenants:seed');
    }
}
