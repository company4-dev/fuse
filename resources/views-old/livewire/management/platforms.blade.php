<?php

use App\Helpers\Composer;
use App\Helpers\Icons;
use App\Helpers\Livewire;
use App\Helpers\Platforms;

use function Livewire\Volt\mount;
use function Livewire\Volt\state;

mount(function () {
    Livewire::layout(
        [
            'dictionary.management',
            'dictionary.platforms',
        ],
        Icons::platforms(),
        [
            [
                'icon'  => 'plus',
                'label' => ['phrases.add', ['dictionary.platform']],
                'route' => 'management.add-platform',
            ],
        ],
    );

    foreach (Platforms::all()->get() as $platform) {
        $this->data[$platform->isEnabled() ? '1' : '0'][] = [
            'dictionary.name'        => $platform->getName(),
            'dictionary.description' => $platform->getDescription(),
            'dictionary.status'      => ___($platform->isEnabled() ? 'dictionary.enabled' : 'dictionary.disabled'),
        ];
    }

    krsort($this->data);

    $this->data = array_merge(...$this->data);
});

state([
    'data' => [
        '1' => [
            [
                'dictionary.name'        => ___('dictionary.jellybean'),
                'dictionary.description' => Composer::getDescription(),
                'dictionary.status'      => ___('dictionary.enabled'),
            ],
        ],
    ],
])->locked();

?>

<div>
    <livewire:table :$data :manual="true" />
</div>
