<?php

use App\Helpers\Icons;
use App\Helpers\Livewire;
use App\Models\User;
use App\View\Forms\Users\User as UserForm;
use Flux\Flux;

use function Livewire\Volt\form;
use function Livewire\Volt\mount;

form(UserForm::class);

mount(function () {
    Livewire::layout(
        [
            'users.list' => 'dictionary.users',
            'dictionary.add',
        ],
        Icons::add(),
    );
});

$submit = fn () => $this->form->process($this, function ($validated) {
    $user = new User;

    $user->email      = $validated['email'];
    $user->first_name = $validated['first_name'];
    $user->last_name  = $validated['last_name'];
    $user->password   = bcrypt(now());
    $user->role_id    = $validated['role_id'];

    $user->save();

    Flux::toast(___('logs.users.created', [$user->name]), variant: 'success');

    return $this->redirect(route('users.view', $user->id));
});

?>

<div class="container">
    <flux:card>
        <x-form :$form />
    </flux:card>
</div>
