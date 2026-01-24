@props([
    'activity' => null,
    'charts'   => null,
    'details',
    'rightTitle' => null,
])

<div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 mb-4">
    <flux:card class="space-y-6">
        <flux:heading class="mb-3" size="lg">{{ ___('dictionary.details') }}</flux:heading>

        <x-details class="space-y-3" :$details />
    </flux:card>

    <flux:card>
        <flux:heading size="lg">{{ ___($charts ? 'dictionary.charts' : ($rightTitle ?? 'dictionary.other')) }}</flux:heading>

        @if ($charts)
            @dump($charts)
        @else
            {{ $slot }}
        @endif
    </flux:card>

    <flux:card>
        <flux:heading size="lg">{{ ___('dictionary.activity') }}</flux:heading>

        @if ($activity)
            @dump($activity)
        @endif
    </flux:card>
</div>
