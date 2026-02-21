<?php

namespace App\Providers;

use App\Helpers\Cache as CacheHelper;
use App\Helpers\Icons as IconsHelper;
use App\Hooks\Menu;
use Illuminate\Database\Eloquent\Model;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Number;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }

        // Automatically eager load relationships on models
        Model::AutomaticallyEagerLoadRelationships();
        // Enforce defined loading or relationships
        Model::shouldBeStrict();

        Number::useCurrency('GBP');

        $this->configureDefaults();

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

    /**
     * Configure default behaviors for production-ready applications.
     */
    protected function configureDefaults(): void
    {
        Date::use(CarbonImmutable::class);

        DB::prohibitDestructiveCommands(
            app()->isProduction(),
        );

        Password::defaults(fn (): ?Password => app()->isProduction()
            ? Password::min(12)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols()
                ->uncompromised()
            : null
        );
    }
}
