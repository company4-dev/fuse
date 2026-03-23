<?php

namespace App\Console\Commands\FuseUpdates;

use App\Helpers\Fuses;
use App\Traits\BaseCommand;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class PostUpdateCommand extends Command
{
    use BaseCommand;

    protected $description = 'Runs actions post file upload';
    protected $signature   = 'post-fuse-update {fuse}';

    public function handle()
    {
        $fuse = Fuses::find($this->argument('fuse'));

        $fuse = $fuse ? $fuse->getName() : $this->argument('fuse');

        $this->log(
            'Resuming update for Fuse as files should have been uploaded: '
                .$fuse
        );

        $this->log('Updating Database: Migrations');
        $this->log('- Core');
        Artisan::call('migrate --force');
        $this->log('- Tenants');
        Artisan::call('tenants:migrate --force');

        $this->log('Updating Database: Changes');
        $this->log('- Core');
        Artisan::call('db:seed --force');
        $this->log('- Tenants');
        Artisan::call('tenants:seed --force');

        $this->log('Restarting Queue');
        Artisan::call('queue:restart');

        $this->log('Updating Caches');
        Artisan::call('optimize:clear');
        Artisan::call('optimize');

        Artisan::call('up');
        $this->log('Done');
    }

    private function log($message, $level = 'info')
    {
        Log::channel('updates')->$level($message);
    }
}
