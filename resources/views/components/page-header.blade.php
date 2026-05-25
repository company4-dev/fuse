@use(App\Helpers\Dates)
@use(App\Models\Activity)

@props([
    'activity' => null,
    'charts'   => null,
    'details',
    'users' => null,
])

@php
    $cols = 0;

    if ($details) {
        $cols++;
    }

    // Users
    if ($users) {
        $cols++;
    }

    // Charts
    if ($charts) {
        $cols++;
    }

    // Activity
    if ($activity) {
        $activity = Activity::forSubject($activity)->limited(3)->getOrdered();

        $cols++;
    }
@endphp

<div>
    <flux:card class="mb-3 space-y-6">
        <div class="gap-4 grid sm:grid-cols-2 md:grid-cols-2 xl:grid-cols-4">
            <x-details class="space-y-3" :$details />

            @if ($users)
                @dump($users)
            @else
                <div></div>
            @endif

            @if ($charts)
                @dump($charts)
            @else
                <div></div>
            @endif

            @if ($activity)
                <flux:timeline class="[--flux-timeline-item-gap:0]">
                    @foreach ($activity as $item)
                        <flux:timeline.item status="complete">
                            <flux:timeline.indicator class="text-xs">
                                {{ Dates::time_ago($item->created_at, absolute: true) }}
                            </flux:timeline.indicator>

                            <flux:timeline.content>
                                <flux:heading>
                                    {{ ___($item->description) }}
                                    <br>
                                    <flux:text inline>
                                        {{ ___(
                                            'phrases.by-at',
                                            [
                                                'by' => $item->causer_name,
                                                'at' => Dates::datetime($item->created_at),
                                            ]
                                        ) }}
                                    </flux:text>
                                </flux:heading>
                            </flux:timeline.content>
                        </flux:timeline.item>
                    @endforeach
                </flux:timeline>
            @endif
        </div>
    </flux:card>
</div>
