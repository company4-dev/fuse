<?php

use App\Helpers\Livewire;
use App\Models\User;
use App\View\Forms\Auth\Register;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;

use function Livewire\Volt\form;
use function Livewire\Volt\layout;
use function Livewire\Volt\mount;

form(Register::class);

layout('components.layouts.auth');

mount(function () {
    Livewire::layout();
});

$submit = fn () => $this->form->process($this, function ($validated) {
    $validated = $validated->toArray();

    $validated['password'] = Hash::make($validated['password']);

    unset($validated['password_confirmation']);

    $user = User::create($validated);

    $user->save(['created_by' => null, 'updated_by' => null]);

    event(new Registered($user));

    Auth::login($user);

    $this->redirectIntended(route('dashboard', absolute: false), navigate: true);
}); ?>

<div class="container">
    @if (session('status'))
        <x-callout variant="success">
            {{ session('status') }}
        </x-callout>
    @endif

    <flux:card>
        <flux:heading class="text-center" size="lg">
            {{ ___('dictionary.register') }}
        </flux:heading>

        <x-separator />

        <x-form :$form type="ungrouped" />
    </flux:card>
</div>
