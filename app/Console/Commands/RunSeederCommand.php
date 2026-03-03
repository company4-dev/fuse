<?php

namespace App\Console\Commands;

use App\Traits\BaseCommand;
use Illuminate\Console\Command;

class RunSeederCommand extends Command
{
    use BaseCommand;

    protected $description = 'Runs database seeders';
    protected $signature   = 'jb:run-seeders';

    public function handle()
    {
        $this->call('db:seed');
        $this->call('tenants:seed');
    }
}
