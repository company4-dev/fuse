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
    }
};
?>

<div>
    <livewire:table lazy table="tenants.tenants" />
</div>
