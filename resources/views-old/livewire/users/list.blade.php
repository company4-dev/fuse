<?php

use App\Helpers\Icons;
use App\Helpers\Livewire;

use function Livewire\Volt\mount;

mount(function () {
    Livewire::layout(
        [
            'dictionary.users',
        ],
        Icons::users(),
        [
            [
                'icon'  => Icons::add(),
                'label' => ['phrases.add', ['dictionary.user']],
                'route' => 'users.add',
            ],
            [
                'icon'  => Icons::roles(),
                'label' => 'dictionary.roles',
                'route' => 'management.roles',
            ],
        ],
    );
});

?>

<div>
    <livewire:table lazy table="users" />
</div>
