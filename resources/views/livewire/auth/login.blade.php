<?php

use App\Livewire\Forms\Auth\Login;
use Livewire\Component;

new class extends Component
{
    public Login $form;
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
