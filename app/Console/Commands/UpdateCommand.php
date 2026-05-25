<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Base\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Process;

class UpdateCommand extends Command
{
    protected $description = 'Runs the JellyBean updater';
    protected $signature   = 'jb:update';

    public function handle(): void
    {
        $tenancy_enabled = config('settings.tenancy.enabled');

        $this->log('Entering Maintenance Mode');
        Artisan::call('optimize:clear');
        Artisan::call('down --refresh=15 --render="errors::503" --secret="0f41693d-9bb7-4fad-9f50-8ec8f3760de6"');

        $this->log('Performing full backup');
        Artisan::call('backup:full');

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

        $this->log('Updating Storage Links');
        Artisan::call('storage:unlink');
        Artisan::call('storage:link');

        Process::run('echo "$(date +"%F %T")" > storage/app/updated.txt');

        Artisan::call('up');
        $this->log('Done');
    }

    private function log(string $message, $level = 'info'): void
    {
        Log::channel('updates')->$level($message);

        $this->$level($message);
    }
}
