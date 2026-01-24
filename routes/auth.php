<?php

use Fuse\Http\Controllers\Auth\VerifyEmailController;
use Fuse\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomainOrSubdomain;

Route::middleware(['guest', 'universal', InitializeTenancyByDomainOrSubdomain::class])->group(function () {
    Volt::route('login', 'auth.login')
        ->name('login');

    // Volt::route('register', 'auth.register')
    //     ->name('register');

    Volt::route('forgot-password', 'auth.forgot-password')
        ->name('password.request');

    Volt::route('reset-password/{token}', 'auth.reset-password')
        ->name('password.reset');
});

Route::middleware(['auth', 'universal', InitializeTenancyByDomainOrSubdomain::class])->group(function () {
    Volt::route('verify-email', 'auth.verify-email')
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Volt::route('confirm-password', 'auth.confirm-password')
        ->name('password.confirm');
});

Route::middleware(['universal', InitializeTenancyByDomainOrSubdomain::class])->group(function () {
    Route::post('logout', Logout::class)
        ->name('logout');
});
