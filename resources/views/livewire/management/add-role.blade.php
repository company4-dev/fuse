<?php

use App\Helpers\Icons;
use App\Helpers\Livewire;
use App\Models\Role;
use App\View\Forms\Management\Role as RoleForm;
use Flux\Flux;

use function Livewire\Volt\form;
use function Livewire\Volt\mount;

form(RoleForm::class);

mount(function () {
    Livewire::layout(
        [
            'dictionary.management',
            'management.roles' => 'dictionary.roles',
            ['phrases.add', ['dictionary.role']],
        ],
        Icons::role(),
    );
});

$submit = fn () => $this->form->process($this, function ($validated) {
    $role = Role::create($validated->toArray());

    Flux::toast('Your changes have been saved.', variant: 'success');

    return $this->redirect(route('management.roles'));
});

?>
<div class="container">
    <flux:card>
        <x-form :$form />
    </flux:card>
</div>
