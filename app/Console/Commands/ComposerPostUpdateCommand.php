<?php

namespace App\Console\Commands;

use App\Helpers\Platforms;
use App\Traits\BaseCommand;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class ComposerPostUpdateCommand extends Command
{
    use BaseCommand;

    protected $description = 'Performs additional actions after composer update.';
    protected $signature   = 'post-update-cmd';

    public function handle()
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

        // Copy Pint
        foreach ($platforms as $platform) {
            $disk->copy('pint.json', 'Platforms/'.$platform->getStudlyName().'/pint.json');
        }
    }
}
