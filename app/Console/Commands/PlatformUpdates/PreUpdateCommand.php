<?php

declare(strict_types=1);

namespace App\Console\Commands\PlatformUpdates;

use App\Base\Command;
use App\Helpers\Platforms;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class PreUpdateCommand extends Command
{
    protected $description = 'Runs update preparations for Platform Updates';
    protected $signature   = 'pre-platform-update {platform}';

    public function handle(): void
    {
        $platform = Platforms::find($this->argument('platform'));

        $platform = $platform ? $platform->getName() : $this->argument('platform');

        $this->log('Starting update for Platform: '.$platform);

        $this->log('Entering Maintenance Mode');
        Artisan::call('optimize:clear');
        Artisan::call('down --refresh=15 --render="errors::503" --secret="0f41693d-9bb7-4fad-9f50-8ec8f3760de6"');

        $this->log('Performing full backup');
        Artisan::call('backup:full');

        $this->log('Awaiting File Uploads...');
    }

    private function log(string $message, $level = 'info'): void
    {
        Log::channel('updates')->$level($message);
    }
}
