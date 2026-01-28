<?php

use Fuse\Helpers\Platforms;
use Fuse\Http\Controllers\UserImpersonationController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomainOrSubdomain;

foreach (config('tenancy.central_domains') as $domain) {
    Route::domain($domain)->group(function () {
        Route
            ::get('/', fn () => view('home'));
    });
}

// Global Routes
Route
    ::middleware([
        'guest',
        'universal',
        InitializeTenancyByDomainOrSubdomain::class,
    ])
    ->group(function () {
        Route::redirect('/', '/login');
    });

Route
    ::middleware(['auth', 'universal', InitializeTenancyByDomainOrSubdomain::class])
    ->group(function () {
        Route::livewire('app', 'dashboard')->name('dashboard');
    });

Route
    ::middleware(['auth', 'verified', 'universal', InitializeTenancyByDomainOrSubdomain::class])
    ->group(function () {
        $livewire_path = '/resources/views/livewire';
        $platforms     = Platforms::active()->get();
        $platform_root = Storage::disk('platforms');
        $root_root     = Storage::disk('root');
        $routes        = [];

        // Base Routes
        $allowed_paths = [
            'management',
            'tenants',
            'users',
        ];

        Route::livewire('app/profile', 'profile')->name('profile');

        foreach ($allowed_paths as $path) {
            $routes['app/'.$path] = $path;

            Route::livewire('app/'.$path, $path.'.list')->name($path);

            foreach ($root_root->allFiles($livewire_path.'/'.$path) as $file) {
                $view_file = Str::replace([substr($livewire_path, 1).'/', '.blade.php'], '', $file);

                $path = 'app/'.$view_file;
                $name = Str::replace(['app/', '/'], ['', '.'], $view_file);

                $routes[$path.'/{id?}'] = $name;

                Route::livewire($path.'/{id?}', $name)->name($name);
            }
        }

        foreach ($platforms as $slug => $platform) {
            $platform_livewire_path = $platform->getStudlyName().$livewire_path;

            foreach ($platform_root->allFiles($platform_livewire_path) as $file) {
                $view_file = Str::replace([$platform_livewire_path.'/', '.blade.php'], '', $file);

                if (!array_key_exists($view_file, $routes)) {
                    $folder = explode('/', $view_file)[0];

                    $routes['app/'.$slug.'/'.$folder] = $slug.'::'.$folder.'.index';

                    Route::livewire('app/'.$slug.'/'.$folder, $slug.'::'.$folder.'.list')->name($slug.'::'.$folder);
                }

                $path = 'app/'.$slug.'/'.$view_file;
                $name = $slug.'::'.Str::replace('/', '.', $view_file);

                $routes[$path.'/{id?}'] = $name;

                Route::livewire($path.'/{id?}', $name)->name($name);
            }
        }

        // dump($routes);
    });

// Edge Cases
Route
    ::middleware([
        'web',
        InitializeTenancyByDomainOrSubdomain::class,
        // PreventAccessFromCentralDomains::class,
    ])
    ->group(function () {
        Route::get('/app/user/impersonate/{token}', UserImpersonationController::class)->name('user.impersonate');
    });

// Auth
require __DIR__.'/auth.php';
