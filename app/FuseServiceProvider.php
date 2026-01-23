<?php

namespace Fuse;

use Illuminate\Support\ServiceProvider;

class FuseServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Database - Migrations
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        // Routes
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');

        // Translations
        $this->loadTranslationsFrom(__DIR__.'/../lang', 'fuse');

        // Views
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'fuse');
    }
}
