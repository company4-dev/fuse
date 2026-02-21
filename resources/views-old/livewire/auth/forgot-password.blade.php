<?php

use App\Helpers\Livewire;
use App\View\Forms\Auth\ForgotPassword;
use Illuminate\Support\Facades\Password;

use function Livewire\Volt\form;
use function Livewire\Volt\layout;
use function Livewire\Volt\mount;

form(ForgotPassword::class);

layout('components.layouts.auth');

mount(function () {
    Livewire::layout();
});

$submit = fn () => $this->form->process($this, function ($validated) {
    Password::sendResetLink(['email' => $validated['email']]);

    session()->flash('status', ___('auth.password-reset-link-sent'));
}); ?>

<div class="container">
    @if (session('status'))
        <x-callout variant="success">
            {{ session('status') }}
        </x-callout>
    @endif

    <flux:card>
        <flux:heading class="text-center mb-3" size="lg">
            {{ ___('phrases.forgot-password') }}
        </flux:heading>

        <x-separator />

        <x-form :$form type="ungrouped" />
    </flux:card>
</div>
