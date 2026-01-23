<?php

namespace Fuse\Console\Commands;

use Company4\Incrementor\Incrementor;
use Fuse\Traits\BaseCommand;
use Illuminate\Console\Command;

class FullBackupCommand extends Command
{
    use BaseCommand;

    protected $description = 'Backup';
    protected $signature   = 'backup:full';

    public function handle()
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
