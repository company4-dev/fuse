<?php

namespace App\Console\Commands;

use App\Helpers\Fuses;
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
        $disk  = Storage::disk('root');
        $fuses = Fuses::all()->get();

        // Copy Git Hooks
        foreach (['pre-commit', 'pre-push'] as $hook) {
            $target = '.git/hooks/'.$hook;

            $disk->copy('contrib/'.$hook, $target);

            chmod($disk->path($target), 0755);

            foreach ($fuses as $fuse) {
                $target = 'Fuses/'.$fuse->getStudlyName().'/.git/hooks/'.$hook;

                // Copy
                $disk->copy('contrib/fuses-'.$hook, $target);

                // Make it run
                chmod($disk->path($target), 0755);
            }
        }

        $disk->copy('contrib/commit-msg', '.git/hooks/commit-msg');

        chmod($disk->path($target), 0755);

        // Copy Pint
        foreach ($fuses as $fuse) {
            $disk->copy(
                'pint.json',
                'Fuses/'.$fuse->getStudlyName().'/pint.json'
            );
        }
    }
}
