<?php

namespace Fuse;

use Fuse\Helpers\Cache as CacheHelper;
use Fuse\Helpers\Icons as IconsHelper;
use Fuse\Hooks\Menu;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Number;
use Illuminate\Support\ServiceProvider;

class FuseServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }

        // Automatically eager load relationships on models
        Model::AutomaticallyEagerLoadRelationships();
        // Enforce defined loading or relationships
        Model::shouldBeStrict();

        Number::useCurrency('GBP');

        // Database - Migrations
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        // Translations
        $this->loadTranslationsFrom(__DIR__.'/../lang', 'fuse');

        // Views
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'fuse');

        View::composer(
            [
                'components.layouts.app',
                'components.layouts.auth',
                'components.layouts.guest',
            ],
            function ($view) {
                $layout = str_replace('layouts.', '', $view->getName());

                $vite = [
                    'resources/css/base.css',
                    'resources/css/'.$layout.'.css',
                    'resources/js/base.js',
                    'resources/js/'.$layout.'.js',
                ];

                View::share([
                    'vite' => $vite,
                ]);
            }
        );

        View::composer(
            [
                'components.layouts.app',
            ],
            function () {
                View::share([
                    'links' => Menu::get(),
                ]);
            }
        );

        $this->app->singleton(CacheHelper::class, fn () => new CacheHelper);
        $this->app->singleton(IconsHelper::class, fn () => new IconsHelper);
    }

    public function register()
    {
        $this->loadFuseConfig();
    }

    protected function loadFuseConfig()
    {
        foreach (glob(__DIR__ . '/../config/*.php') as $file) {
            $this->mergeConfigFrom($file, basename($file, '.php'));
        }
    }

    private function loadFuseRoutes()
    {
        $this->app->booted(function() {
            if (Route::hasMacro('livewire')) {
                foreach (glob(__DIR__ . '/../routes' . '/*.php') as $file) {
                    $this->loadRoutesFrom($file);
                }
            }
        });
    }
}
