<?php

declare(strict_types=1);

namespace App\Console\Commands\PlatformUpdates;

use App\Base\Command;
use App\Helpers\Platforms;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class PostUpdateCommand extends Command
{
    protected $description = 'Runs actions post file upload';
    protected $signature   = 'post-platform-update {platform}';

    public function handle(): void
    {
        $platform        = Platforms::find($this->argument('platform'));
        $tenancy_enabled = config('settings.tenancy.enabled');

        $platform = $platform ? $platform->getName() : $this->argument('platform');

        $this->log('Resuming update for Platform as files should have been uploaded: '.$platform);

        $this->log('Updating Database: Migrations');
        $this->log('- Core');
        Artisan::call('migrate --force');

        if ($tenancy_enabled) {
            $this->log('- Tenants');
            Artisan::call('tenants:migrate --force');
        }

        $this->log('Updating Database: Changes');
        $this->log('- Core');
        Artisan::call('db:seed --force');

        if ($tenancy_enabled) {
            $this->log('- Tenants');
            Artisan::call('tenants:seed --force');
        }

        $this->log('Restarting Queue');
        Artisan::call('queue:restart');

        $this->log('Updating Caches');
        Artisan::call('optimize:clear');
        Artisan::call('optimize');

        Artisan::call('up');
        $this->log('Done');
    }

    private function log(string $message, $level = 'info'): void
    {
        Log::channel('updates')->$level($message);
    }
}
