<?php

use App\Helpers\Icons;
use App\Helpers\Livewire;
use App\Models\Role;

use function Livewire\Volt\mount;
use function Livewire\Volt\state;

mount(function (int $id) {
    $this->role = Role::findOrRedirect($id, 'management.roles');

    $this->tabs = [
        [
            'icon'  => Icons::permissions(),
            'label' => 'dictionary.permissions',
        ],
    ];

    Livewire::layout(
        [
            'dictionary.management',
            'management.roles' => 'dictionary.roles',
            $this->role->name,
        ],
        Icons::role(),
        [
            [
                'icon'  => Icons::edit(),
                'label' => ['phrases.edit', ['dictionary.role']],
                'route' => ['management.edit-role', $this->role->id],
            ],
        ]
    );
});

state([
    'role' => null,
    'tabs' => null,
])->locked();

?>

<div>
    <x-page-header
        :activity="null"
        :charts="null"
        :details="[
            [
                'icon'  => Icons::user(),
                'label' => 'dictionary.name',
                'value' => $role->name,
            ],
        ]"
        right-title="// Something Else"
    >
        Content for something else
    </x-page-header>

    <x-tabs :$tabs>
        <x-tab target="dictionary.permissions">
            <livewire:table :id="$role->id" lazy table="permissions" />
        </x-tab>
    </x-tabs>
</div>
