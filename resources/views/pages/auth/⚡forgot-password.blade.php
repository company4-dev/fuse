<?php

declare(strict_types=1);

use App\Extensions\Livewire\Component;
use App\View\Forms\Auth\ForgotPassword;
use Illuminate\Support\Facades\Password;

new class extends Component
{
    public ForgotPassword $form;
    public string $password = '';

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
            Password::sendResetLink(['email' => $validated['email']]);

            session()->flash('status', ___('auth.password-reset-link-sent'));
        });
    }
}; ?>

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
