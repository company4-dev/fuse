<?php

use App\Helpers\Tenancy;
use App\Http\Controllers\UserImpersonationController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomainOrSubdomain;

$tenancy_enabled    = Tenancy::enabled();
$tenancy_middleware = $tenancy_enabled ? ['universal', InitializeTenancyByDomainOrSubdomain::class] : [];

if ($tenancy_enabled) {
    foreach (config('tenancy.central_domains') as $domain) {
        Route::domain($domain)->group(function () {
            Route
                ::get('/', fn () => view('home'));
        });
    }
} else {
    Route::get('/', fn () => view('home'));
}

// Global Routes
Route
    ::middleware(array_merge(['guest'], $tenancy_middleware))
    ->group(function () {
        Route::redirect('/', '/login');
    });

Route
    ::middleware(array_merge(['auth'], $tenancy_middleware))
    ->group(function () {
        Route::livewire('app', 'dashboard')->name('dashboard');
    });

Route
    ::middleware(array_merge(['auth', 'verified'], $tenancy_middleware))
    ->group(function () {
        $livewire_path = '/resources/views/livewire';
        // $fuse_root     = Storage::disk('fuse');
        $fuse_root     = Storage::disk('local');
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

            foreach ($fuse_root->allFiles($livewire_path.'/'.$path) as $file) {
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
if ($tenancy_enabled) {
    Route
        ::middleware([
            'web',
            InitializeTenancyByDomainOrSubdomain::class,
            // PreventAccessFromCentralDomains::class,
        ])
        ->group(function () {
            Route::get('/app/user/impersonate/{token}', UserImpersonationController::class)->name('user.impersonate');
        });
}

// Auth
require __DIR__.'/auth.php';
require __DIR__.'/settings.php';
