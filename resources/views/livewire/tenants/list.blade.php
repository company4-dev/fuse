<?php

use App\Helpers\Icons;
use App\Helpers\Livewire;

use function Livewire\Volt\mount;

mount(function () {
    Livewire::layout(
        [
            'dictionary.tenants',
        ],
        Icons::tenants(),
        [
            [
                'icon'  => Icons::add(),
                'label' => ['phrases.add', ['dictionary.tenant']],
                'route' => 'tenants.add',
            ],
        ],
    );
});

?>

<div>
    <livewire:table lazy table="tenants.tenants" />
</div>
