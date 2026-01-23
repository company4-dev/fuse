<?php

namespace Fuse\Console\Commands;

use Fuse\Traits\BaseCommand;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class RunFontAwesomeCacheCommand extends Command
{
    use BaseCommand;

    protected $description = 'Cache Font Awesome including generating FluxUI Icon files';
    protected $signature   = 'jb:run-fontawesome-cache';

    public function handle()
    {
        $disk  = Storage::disk('root');
        $icons = $disk->allFiles('resources/vendor/fontawesome');
        $stub  = $disk->get('stubs/fontawesome.stub');

        foreach ($icons as $icon) {
            $attributes = [];
            $file       = basename($icon, '.svg');
            $svg        = $disk->get($icon);
            $svg        = simplexml_load_string($svg);

            foreach ($svg->attributes() as $key => $value) {
                $attributes[] = $key.'="'.$value.'"';
            }

            $attributes[] = 'fill="currentColor"';
            $children     = '';

            foreach ($svg->children() as $child) {
                $children .= $child->asXML();
            }

            $disk->put(
                'resources/views/flux/icon/'.$file.'.blade.php',
                str_replace(
                    [
                        '{{ attributes }}',
                        '{{ svg }}',
                    ],
                    [
                        implode(' ', $attributes),
                        $children,
                    ],
                    $stub
                )
            );

            $disk->delete($icon);
        }
    }
}
