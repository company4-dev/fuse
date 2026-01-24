<?php

namespace Fuse\Providers;

use Illuminate\Support\ServiceProvider;
use Override;

class PlatformServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    #[Override]
    public function register(): void
    {
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
    }
}
