<?php

declare(strict_types=1);

use App\Helpers\Composer;
use App\Helpers\Icons;
use App\Extensions\Livewire\Component;
use App\Helpers\Platforms;
use Livewire\Attributes\Locked;

new class extends Component
{
    #[Locked]
    public $data;

    public function mount()
    {
        $data = [
            '1' => [
                [
                    'dictionary.name'        => ___('dictionary.jellybean'),
                    'dictionary.description' => Composer::getDescription(),
                    'dictionary.status'      => ___('dictionary.enabled'),
                ],
            ],
        ];

        foreach (Platforms::all()->get() as $platform) {
            $data[$platform->isEnabled() ? '1' : '0'][] = [
                'dictionary.name'        => $platform->getName(),
                'dictionary.description' => $platform->getDescription(),
                'dictionary.status'      => ___($platform->isEnabled() ? 'dictionary.enabled' : 'dictionary.disabled'),
            ];
        }

        krsort($data);

        $this->data = array_merge(...$data);

        $this->layout(
            [
                'management' => 'dictionary.management',
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
    }
};
?>

<div>
    <livewire:table :$data manual />
</div>
