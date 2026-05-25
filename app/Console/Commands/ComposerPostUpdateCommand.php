<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Base\Command;
use App\Helpers\Platforms;
use Illuminate\Support\Facades\Storage;

class ComposerPostUpdateCommand extends Command
{
    protected $description = 'Performs additional actions after composer update.';
    protected $signature   = 'post-update-cmd';

    public function handle(): void
    {
        $disk      = Storage::disk('root');
        $platforms = Platforms::all()->get();

        // Copy Git Hooks
        foreach (['pre-commit', 'pre-push'] as $hook) {
            $target = '.git/hooks/'.$hook;

            $disk->copy('contrib/'.$hook, $target);

            chmod($disk->path($target), 0755);

            foreach ($platforms as $platform) {
                $target = 'Platforms/'.$platform->getStudlyName().'/.git/hooks/'.$hook;

                // Copy
                $disk->copy('contrib/platform-'.$hook, $target);

                // Make it run
                chmod($disk->path($target), 0755);
            }
        }

        $disk->copy('contrib/commit-msg', '.git/hooks/commit-msg');

        chmod($disk->path($target), 0755);
    }
}
