<?php

namespace App\Console\Commands;

use Company4\Incrementor\Incrementor;
use App\Traits\BaseCommand;
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
