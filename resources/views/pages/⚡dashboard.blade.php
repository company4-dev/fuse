<?php

declare(strict_types=1);

use App\Enums\Dashboard\Renderer;
use App\Enums\Dashboard\Type;
use App\Helpers\Icons;
use App\Extensions\Livewire\Component;
use App\Hooks\Dashboard;

new class extends Component
{
    public array $charts;
    public array $snacks;

    public function mount()
    {
        $items = Dashboard::get();

        foreach ($items as $item) {
            $type = $item['type'];

            unset($item['type']);

            $item['renderer'] = $item['renderer']->name;

            if ($type === Type::Chart) {
                $this->charts[] = $item;
            } elseif ($type === Type::Snack) {
                $this->snacks[] = Renderer::fromName($item['renderer'])->render($item['file']);
            }
        }

        $this->layout(avatar: Icons::dashboard());
    }
};
?>

<div>
    @if ($charts)
        {{-- Charts --}}
        <x-grid class="mb-5">
            @foreach ($charts as $chart)
                <flux:skeleton animate="shimmer" class="aspect-[2/1] size-full rounded-lg" />
            @endforeach
        </x-grid>
    @endif

    @if ($snacks)
        {{-- Snacks --}}
        <x-grid>
            @foreach ($snacks as $snack)
                <flux:card class="p-0">
                    {!! $snack !!}
                </flux:card>
            @endforeach
        </x-grid>
    @endif
</div>
