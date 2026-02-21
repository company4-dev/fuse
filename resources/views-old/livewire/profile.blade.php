<?php

use App\Helpers\Livewire;
use App\View\Forms\Users\Profile;
use Flux\Flux;
use Illuminate\Support\Facades\Auth;

use function Livewire\Volt\form;
use function Livewire\Volt\mount;
use function Livewire\Volt\state;

form(Profile::class);

mount(function () {
    $this->user = Auth::user();

    $this->form->model($this->user);

    Livewire::layout(
        [
            'users.list' => 'dictionary.users',
            $this->user->name,
        ],
        $this->user->avatar,
    );
});

state([
    'status' => null,
    'user'   => null,
]);

$submit = fn () => $this->form->process(
    $this,
    function ($validated) {
        $this->user->email      = $validated['email'];
        $this->user->first_name = $validated['first_name'];
        $this->user->last_name  = $validated['last_name'];
        $this->user->password   = Hash::make($validated['new_password']);

        $this->user->save();

        Flux::toast(___('logs.users.updated', [$this->user->name]), variant: 'success');

        return $this->redirect(route('profile'));
    },
    error: function ($validator, $data) {
        $this->form->reset([
            'existing_password',
            'new_password',
            'new_password_confirmation',
        ]);
    }
);

?>
<div class="container">
    <flux:card>
        <x-form :$form />
    </flux:card>
</div>
