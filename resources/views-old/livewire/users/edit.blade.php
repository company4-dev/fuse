<?php

use App\Helpers\Livewire;
use App\Models\User;
use App\View\Forms\Users\User as UserForm;
use Flux\Flux;

use function Livewire\Volt\form;
use function Livewire\Volt\mount;
use function Livewire\Volt\state;

form(UserForm::class);

mount(function ($id) {
    $this->user = User::find($id);

    $this->form->model($this->user);

    Livewire::layout(
        [
            'users.list'                  => 'dictionary.users',
            'users.view:'.$this->user->id => $this->user->name,
            'dictionary.edit',
        ],
        $this->user->avatar,
    );
});

state([
    'user' => null,
]);

$submit = fn () => $this->form->process($this, function ($validated) {
    $this->user->first_name = $validated['first_name'];
    $this->user->role_id    = $validated['role_id'];
    $this->user->last_name  = $validated['last_name'];

    $this->user->save();

    Flux::toast(___('logs.users.updated', [$this->user->name]), variant: 'success');

    return $this->redirect(route('users.view', $this->user->id));
});

?>
<div class="container">
    <flux:card>
        <x-form :$form />
    </flux:card>
</div>
