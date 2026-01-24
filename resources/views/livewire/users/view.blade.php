<?php

use App\Helpers\Icons;
use App\Helpers\Livewire;
use App\Models\User;

use function Livewire\Volt\mount;
use function Livewire\Volt\state;

mount(function ($id) {
    $this->user = User::find($id);

    Livewire::layout(
        [
            'users.list' => 'dictionary.users',
            $this->user->name,
        ],
        $this->user->avatar,
        [
            [
                'icon'  => Icons::edit(),
                'label' => ['phrases.edit', ['dictionary.user']],
                'route' => ['users.edit', $this->user->id],
            ],
        ]
    );
});

state([
    'user' => null,
]);

?>

<x-page-header
    :activity="null"
    :charts="null"
    :details="[
        [
            'icon'  => Icons::user(),
            'label' => 'dictionary.name',
            'value' => $user->name,
        ],
        [
            'icon'  => Icons::status(),
            'label' => 'dictionary.status',
            'value' => $user->status_id->details('label'),
        ],
        [
            'icon'  => 'identification',
            'label' => 'dictionary.role',
            'value' => $user->role_id->details('label'),
        ]
    ]"
    right-title="// Something Else"
>
    Content for something else
</x-page-header>
