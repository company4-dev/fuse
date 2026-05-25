<?php

declare(strict_types=1);

use App\Http\Controllers\Auth\VerifyEmailController;
use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomainOrSubdomain;

$tenancy_enabled = config('settings.tenancy.enabled');

Route
    ::middleware($tenancy_enabled
        ? [
            'guest',
            'universal',
            InitializeTenancyByDomainOrSubdomain::class,
        ]
        : ['guest'])
    ->group(function (): void {
        Route
            ::livewire('login', 'pages::auth.login')
            ->name('login');

        // Route
        //     ::livewire('register', 'auth.register')
        //     ->name('register');

        Route
            ::livewire('forgot-password', 'pages::auth.forgot-password')
            ->name('password.request');

        Route
            ::livewire('reset-password/{token}', 'pages::auth.reset-password')
            ->name('password.reset');
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
        Route
            ::livewire('verify-email', 'pages::auth.verify-email')
            ->name('verification.notice');

        Route
            ::get('verify-email/{id}/{hash}', VerifyEmailController::class)
            ->middleware(['signed', 'throttle:6,1'])
            ->name('verification.verify');

        Route
            ::livewire('confirm-password', 'pages::auth.confirm-password')
            ->name('password.confirm');
    });

if ($tenancy_enabled) {
    Route
        ::middleware(['universal', InitializeTenancyByDomainOrSubdomain::class])
        ->group(function (): void {
            Route
                ::post('logout', Logout::class)
                ->name('logout');
        });
} else {
    Route
        ::post('logout', Logout::class)
        ->name('logout');
}
