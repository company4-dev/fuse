<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Base\Command;
use Company4\Incrementor\Incrementor;

class IncrementalBackupCommand extends Command
{
    protected $description = 'Backup';
    protected $signature   = 'backup:incremental';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $incrementor = new Incrementor(
            base_path(''),
            'backups',
        );

        // Create full backup
        $incrementor->run();
    }
}
