<?php

declare(strict_types=1);

use App\Extensions\Livewire\Component;
use App\View\Forms\Auth\Login;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

new class extends Component
{
    public Login $form;

    public function mount()
    {
        $this->layout();
    }

    public function render()
    {
        return $this->view()->layout('layouts::auth');
    }

    public function submit()
    {
        $this->form->process($this, function ($validated) {
            $throttle_key = $this->throttle_key($validated);

            $this->ensure_is_not_rate_limited($validated);

            if (!Auth::attempt(
                [
                    'email'    => $this->form->email,
                    'password' => $this->form->password,
                ],
                $this->form->remember
            )) {
                RateLimiter::hit($throttle_key);

                throw ValidationException::withMessages([
                    'email' => ___('auth.failed'),
                ]);
            }

            RateLimiter::clear($throttle_key);
            Session::regenerate();

            $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
        });
    }

    private function ensure_is_not_rate_limited($validated)
    {
        $throttle_key = $this->throttle_key($validated);

        if (!RateLimiter::tooManyAttempts($throttle_key, 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($throttle_key);

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
