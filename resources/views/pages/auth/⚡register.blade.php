<?php

declare(strict_types=1);

use App\Extensions\Livewire\Component;
use App\Models\User;
use App\View\Forms\Auth\Register;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

new class extends Component
{
    public Register $form;

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
            $validated = $validated->toArray();

            $validated['password'] = Hash::make($validated['password']);

            unset($validated['password_confirmation']);

            $user = User::create($validated);

            $user->save(['created_by' => null, 'updated_by' => null]);

            event(new Registered($user));

            Auth::login($user);

            $this->redirectIntended(route('dashboard', absolute: false), navigate: true);
        });
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
            {{ ___('dictionary.register') }}
        </flux:heading>

        <x-separator />

        <x-form :$form type="ungrouped" />
    </flux:card>
</div>
