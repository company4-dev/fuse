<?php

use App\Helpers\Icons;
use App\Helpers\Livewire;

new class extends Livewire
{
    public function mount()
    {
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
    }
};
?>

<div>
    <livewire:table lazy table="users" />
</div>
