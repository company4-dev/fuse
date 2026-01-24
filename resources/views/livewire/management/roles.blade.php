<?php

use App\Helpers\Icons;
use App\Helpers\Livewire;

use function Livewire\Volt\mount;

mount(function () {
    Livewire::layout(
        [
            'dictionary.management',
            'dictionary.roles',
        ],
        Icons::roles(),
        [
            [
                'icon'  => 'plus',
                'label' => ['phrases.add', ['dictionary.role']],
                'route' => 'management.add-role',
            ],
        ],
    );
});

?>

<div>
    <livewire:table lazy table="roles" />
</div>
