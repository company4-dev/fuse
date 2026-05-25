<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Base\Command;
use Illuminate\Support\Facades\Storage;

class CleanUpCommand extends Command
{
    protected $description = 'Clean up old stuff';
    protected $signature   = 'clean:up';

    public function handle(): void
    {
        foreach (Storage::allFiles('Exports') as $export) {
            if (time() - Storage::lastModified($export) > config('settings.notifications.lifetime')) {
                Storage::delete($export);
            }
        }
    }
}
