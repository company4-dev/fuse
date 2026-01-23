<?php

namespace Fuse\Console\Commands;

use Company4\Incrementor\Incrementor;
use Fuse\Traits\BaseCommand;
use Illuminate\Console\Command;

class IncrementalBackupCommand extends Command
{
    use BaseCommand;

    protected $description = 'Backup';
    protected $signature   = 'backup:incremental';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $incrementor = new Incrementor(
            base_path(''),
            'backups',
        );

        // Create full backup
        $incrementor->run();
    }
}
