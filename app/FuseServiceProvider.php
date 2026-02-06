<?php

namespace Fuse;

use Fuse\Helpers\Cache as CacheHelper;
use Fuse\Helpers\Icons as IconsHelper;
use Fuse\Hooks\Menu;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
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

        $this->loadFuseRoutes();

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
        once(fn () => \Fuse\Helpers\Log::critical('Check for for: https://github.com/livewire/livewire/pull/9903'));

        \Fuse\Helpers\Log::emergency('This is not working. We need to load the fuse config, then recursively merge in the base laravel config files.');

        foreach (glob(__DIR__ . '/../config/*.php') as $file) {
            $basename   = basename($file, '.php');
            $fuseConfig = include $file;

            dd($fuseConfig);

            // Get the main app config if it exists
            $appConfig = config($basename, []);

            // Merge: Fuse config first, then override with app config
            $mergedConfig = array_merge($fuseConfig, $appConfig);

            // Set the merged config
            config([$basename => $mergedConfig]);
        }

        // dd(config());
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
