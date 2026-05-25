<?php

declare(strict_types=1);

use App\Helpers\Platforms;
use App\Http\Controllers\UserImpersonationController;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomainOrSubdomain;

$is_dev          = is_dev();
$tenancy_enabled = config('settings.tenancy.enabled');

if ($tenancy_enabled) {
    foreach (config('tenancy.central_domains') as $domain) {
        Route::domain($domain)->group(function (): void {
            Route
                ::get('/', fn (): Factory|View => view('home'));
        });
    }
}

// Global Routes
Route
    ::middleware($tenancy_enabled
        ? [
            'guest',
            'universal',
            InitializeTenancyByDomainOrSubdomain::class,
        ]
        : ['guest'])
    ->group(function (): void {
        Route::redirect('/', '/login');
    });

Route
    ::middleware($tenancy_enabled
        ? [
            'auth',
            'universal',
            InitializeTenancyByDomainOrSubdomain::class,
        ]
        : ['auth'])
    ->group(function (): void {
        Route::livewire('app', 'pages::dashboard')->name('dashboard');
    });

Route
    ::middleware($tenancy_enabled
        ? [
            'auth',
            'verified',
            'universal',
            InitializeTenancyByDomainOrSubdomain::class,
        ]
        : ['auth'])
    ->group(function () use ($is_dev): void {
        $livewire_path = '/resources/views/pages';
        $platforms     = Platforms::active()->get();
        $platform_root = Storage::disk('platforms');
        $root_root     = Storage::disk('root');
        $routes        = [];

        // Base Routes
        $allowed_paths = array_filter([
            $is_dev ? 'developer' : null,
            'management',
            'tenants',
            'users',
        ]);

        Route
            ::livewire('app/profile', 'pages::profile')
            ->name('profile');

        foreach ($allowed_paths as $path) {
            $routes['app/'.$path] = 'pages::'.$path.'.index';

            Route
                ::livewire('app/'.$path, 'pages::'.$path.'.index')
                ->name($path);

            foreach ($root_root->allFiles($livewire_path.'/'.$path) as $file) {
                $view_file = Str::replace([substr($livewire_path, 1).'/', '.blade.php', '⚡', '⚡︎', '⚡️'], '', $file);

                $path = 'app/'.$view_file;
                $name = Str::replace(['app/', '/'], ['', '.'], $view_file);

                $routes[$path.'/{id?}'] = 'pages::'.$name;

                Route
                    ::livewire($path.'/{id?}', 'pages::'.$name)
                    ->name($name);
            }
        }

        foreach ($platforms as $slug => $platform) {
            $platform_livewire_path = $platform->getStudlyName().$livewire_path;

            foreach ($platform_root->allFiles($platform_livewire_path) as $file) {
                $folder    = null;
                $view_file = Str::replace([$platform_livewire_path.'/', '.blade.php', '⚡', '⚡︎', '⚡️'], '', $file);
                $folder    = explode('/', $view_file)[0];

                if (!array_key_exists($view_file, $routes)) {
                    $routes['app/'.$slug.'/'.$folder] = $slug.'.pages::'.$folder.'.index';

                    Route
                        ::livewire('app/'.$slug.'/'.$folder, $slug.'.pages::'.$folder.'.index')
                        ->name($slug.'.pages::'.$folder);
                }

                $path = 'app/'.$slug.'/'.$view_file;
                $name = $slug.'.pages::'.Str::replace('/', '.', $view_file);

                $routes[$path.'/{id?}'] = $name;

                Route
                    ::livewire($path.'/{id?}', $name)
                    ->name($name);
            }
        }
    });

// Edge Cases
if ($tenancy_enabled) {
    Route
        ::middleware([
            'web',
            InitializeTenancyByDomainOrSubdomain::class,
            // PreventAccessFromCentralDomains::class,
        ])
        ->group(function (): void {
            Route
                ::get('/app/user/impersonate/{token}', UserImpersonationController::class)
                ->name('user.impersonate');
        });
}

// Auth
require __DIR__.'/auth.php';
