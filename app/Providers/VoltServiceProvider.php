<?php

namespace Fuse\Providers;

use Fuse\Helpers\Platforms;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Livewire\Volt\Volt;
use Override;

class VoltServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    #[Override]
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $mounts = [
            config('livewire.view_path', resource_path('views/livewire')),
            resource_path('views/pages'),
        ];

        foreach (Platforms::active()->get() as $slug => $platform) {
            $mounts[] = $platform->getPath().'/resources/views/livewire';

            View::addNamespace($slug, $platform->getPath().'/resources/views');
        }

        Volt::mount($mounts);
    }
}
