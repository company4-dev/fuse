<?php

use App\Helpers\Livewire;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use App\Livewire\Forms\Auth\Register;
use Livewire\Attributes\Layout;

new  #[Layout('layouts::auth', ['title' => 'Register'])] class extends Livewire
{
    public Register $form;

    public function mount()
    {
        Livewire::layout();
    }

    public function submit(): void
    {
        $this->form->process(
            $this,
            function ($validated) {
                $validated = $validated->toArray();

                $validated['password'] = Hash::make($validated['password']);

                unset($validated['password_confirmation']);

                $user = User::create($validated);

                $user->save(['created_by' => null, 'updated_by' => null]);

                event(new Registered($user));

                Auth::login($user);

                $this->redirectIntended(route('dashboard', absolute: false), navigate: true);
            }
        );
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
                {{ ___('dictionary.register') }}
            </flux:heading>

            <x-separator />

            <x-form :$form type="ungrouped" />
        </flux:card>
    </x-layouts::auth>
</div>
