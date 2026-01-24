<?php

use App\Helpers\Icons;
use App\Helpers\Livewire;
use App\Models\Permission;
use App\Models\Role;
use App\View\Forms\Management\Role as RoleForm;
use Flux\Flux;

use function Livewire\Volt\form;
use function Livewire\Volt\mount;
use function Livewire\Volt\state;

form(RoleForm::class);

mount(function (int $id) {
    $this->role = Role::findOrRedirect($id, 'management.roles');

    Livewire::layout(
        [
            'dictionary.management',
            'management.roles'                 => 'dictionary.roles',
            'management.role:'.$this->role->id => $this->role->name,
            ['phrases.edit', ['dictionary.role']],
        ],
        Icons::role(),
    );

    $this->form->options = Permission::toSelect();
    $this->form->model($this->role);
});

state([
    'role' => null,
])
->locked();

$submit = fn () => $this->form->process($this, function ($validated) {
    $permissions = Arr::flatten($validated['permissions'], 1);

    $this->role->permissions()->sync($permissions);

    Flux::toast('Your changes have been saved.', variant: 'success');

    return $this->redirect(route('management.roles'));
});

?>
<div class="container">
    <flux:card>
        <x-form :$form />
    </flux:card>
</div>
