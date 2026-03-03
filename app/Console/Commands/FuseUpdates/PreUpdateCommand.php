<?php

namespace App\Console\Commands\FuseUpdates;

use App\Helpers\Fuses;
use App\Traits\BaseCommand;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class PreUpdateCommand extends Command
{
    use BaseCommand;

    protected $description = 'Runs update preparations for Fuse Updates';
    protected $signature   = 'pre-fuse-update {fuse}';

    public function handle()
    {
        $fuse = Fuses::find($this->argument('fuse'));

        $fuse = $fuse ? $fuse->getName() : $this->argument('fuse');

        $this->log('Starting update for Fuse: '.$fuse);

        $this->log('Entering Maintenance Mode');
        Artisan::call('optimize:clear');
        Artisan::call('down --refresh=15 --render="errors::503" --secret="0f41693d-9bb7-4fad-9f50-8ec8f3760de6"');

        $this->log('Performing full backup');
        Artisan::call('backup:full');

        $this->log('Awaiting File Uploads...');
    }

    private function log($message, $level = 'info')
    {
        Log::channel('updates')->$level($message);
    }
}
