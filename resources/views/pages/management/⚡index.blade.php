<?php

declare(strict_types=1);

use App\Helpers\Cache;
use App\Helpers\Dates;
use App\Helpers\Icons;
use App\Extensions\Livewire\Component;
use App\Hooks\Management;
use Illuminate\Support\Number;
use Livewire\Attributes\Locked;

new class extends Component
{
    #[Locked]
    public $details;

    #[Locked]
    public $groups;

    public function mount()
    {
        $free_space  = disk_free_space('/');
        $total_space = disk_total_space('/');
        $updated_at  = file_get_contents(base_path('storage/app/updated.txt'));

        $this->details = [
            [
                'icon'  => Icons::disk(),
                'label' => 'phrases.free-space',
                'value' => Number::fileSize($free_space, 1).' / '.Number::fileSize($total_space, 1)
                    .' ('.Number::percentage($free_space / $total_space * 100, 1).')',
            ],
            [
                'icon'  => Icons::version(),
                'label' => 'dictionary.version',
                'value' => Cache::version(),
            ],
            [
                'icon'  => Icons::time($updated_at),
                'label' => 'phrases.updated-at',
                'value' => Dates::datetime($updated_at),
            ],
        ];

        $this->groups = Management::get();

        $this->layout(
            [
                'dictionary.management',
            ],
            Icons::management(),
        );
    }
};
?>

<div>
    <x-page-header :$details />

    <x-grid cols="4">
        @foreach ($groups as $group => $links)
            <flux:card>
                <flux:heading class="gap-2">{{ ___($group) }}</flux:heading>

                <flux:navlist class="gap-2">
                    <flux:navlist.group class="mt-3">
                        @foreach ($links as $link)
                            <flux:navlist.item class="px-0" :href="route($link['route'])" :icon="$link['icon']">
                                {{ $link['label'] }}
                            </flux:navlist.item>
                        @endforeach
                    </flux:navlist.group>
                </flux:navlist>
            </flux:card>
        @endforeach
    </x-grid>
</div>
