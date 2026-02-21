<?php

use App\Helpers\Livewire;
use App\View\Forms\Auth\Login;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

use function Livewire\Volt\form;
use function Livewire\Volt\layout;
use function Livewire\Volt\mount;

form(Login::class);

layout('components.layouts.auth');

mount(function () {
    Livewire::layout();
});

$throttle_key = fn ($validated) => Str::transliterate(Str::lower($validated['email']).'|'.request()->ip());

$ensure_is_not_rate_limited = function ($validated) use ($throttle_key): void {
    if (!RateLimiter::tooManyAttempts($throttle_key($validated), 5)) {
        return;
    }

    event(new Lockout(request()));

    $seconds = RateLimiter::availableIn($throttle_key($validated));

    throw ValidationException::withMessages([
        'email' => ___('auth.throttle', [
            'minutes' => ceil($seconds / 60),
            'seconds' => $seconds,
        ]),
    ]);
};

$submit = fn () => $this->form->process($this, function ($validated) use ($ensure_is_not_rate_limited, $throttle_key) {
    $ensure_is_not_rate_limited($validated);

    if (!Auth::attempt(['email' => $this->form->email, 'password' => $this->form->password], $this->form->remember)) {
        RateLimiter::hit($throttle_key($validated));

        throw ValidationException::withMessages([
            'email' => ___('auth.failed'),
        ]);
    }

    RateLimiter::clear($throttle_key($validated));
    Session::regenerate();

    $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
});

?>
<div class="container">
    @if (session('status'))
        <x-callout variant="success">
            {{ session('status') }}
        </x-callout>
    @endif

    <flux:card>
        <flux:heading class="text-center" size="lg">
            {{ ___('dictionary.login') }}
        </flux:heading>

        <x-separator />

        <x-form :$form type="ungrouped" />
    </flux:card>
</div>
