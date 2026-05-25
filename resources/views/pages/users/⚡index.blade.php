<?php

declare(strict_types=1);

use App\Helpers\Icons;
use App\Extensions\Livewire\Component;

new class extends Component
{
    public function mount()
    {
        $this->layout(
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
