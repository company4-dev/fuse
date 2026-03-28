<?php

namespace App\Console\Commands;

use App\Traits\BaseCommand;
use Company4\Incrementor\Incrementor;
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
