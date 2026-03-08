<?php

use App\Helpers\Livewire;
use App\Livewire\Forms\Auth\Login;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

new class extends Livewire
{
    public Login $form;

    public function mount()
    {
        Livewire::layout();
    }

    public function submit()
    {
        $this->form->process(
            $this,
            function ($validated) {
                $this->ensure_is_not_rate_limited($validated);

                if (!Auth::attempt(['email' => $this->form->email, 'password' => $this->form->password], $this->form->remember)) {
                    RateLimiter::hit($this->throttle_key($validated));

                    throw ValidationException::withMessages([
                        'email' => ___('auth.failed'),
                    ]);
                }

                RateLimiter::clear($this->throttle_key($validated));
                Session::regenerate();

                $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
            }
        );
    }

    private function ensure_is_not_rate_limited($validated): void {
        if (!RateLimiter::tooManyAttempts($this->throttle_key($validated), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttle_key($validated));

        throw ValidationException::withMessages([
            'email' => ___('auth.throttle', [
                'minutes' => ceil($seconds / 60),
                'seconds' => $seconds,
            ]),
        ]);
    }

    private function throttle_key($validated)
    {
        return Str::transliterate(Str::lower($validated['email']).'|'.request()->ip());
    }
};
?>

<div>
    <x-layouts::auth :title="__('Log in')">
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

            <x-form :action="route('login.store')" :$form type="ungrouped" />
        </flux:card>
    </x-layouts::auth>
</div>
