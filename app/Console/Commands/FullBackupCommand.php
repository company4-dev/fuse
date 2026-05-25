<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Base\Command;
use Company4\Incrementor\Incrementor;

class FullBackupCommand extends Command
{
    protected $description = 'Backup';
    protected $signature   = 'backup:full';

    public function handle(): void
    {
        $incrementor = new Incrementor(
            base_path(''),
            'backups',
        );

        // Create full backup
        $incrementor->run(false);

        // Delete old full backups
        $incrementor->delete();
    }
}
