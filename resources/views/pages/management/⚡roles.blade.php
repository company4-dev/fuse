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
                'management' => 'dictionary.management',
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
    }
};
?>

<div>
    <livewire:table lazy table="roles" />
</div>
