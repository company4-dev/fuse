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
