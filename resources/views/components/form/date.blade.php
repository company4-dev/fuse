<flux:field class="mb-5" :$hidden>
    <flux:label :badge="$required ? ___('dictionary.required') : null">{{ $label }}</flux:label>

    @if ($modifier === 'change')
        <flux:date-picker
            :$disabled
            :$max
            :$min
            :mode="$type === 'date' ? 'single' : 'range'"
            :$placeholder
            :$required
            selectable-header
            start-day="1"
            :wire:model.change="$name"
            :with-presets="$type === 'date-range'"
            with-today
        />
    @elseif ($modifier === 'live')
        <flux:date-picker
            :$disabled
            :$max
            :$min
            :mode="$type === 'date' ? 'single' : 'range'"
            :$placeholder
            :$required
            selectable-header
            start-day="1"
            :wire:model.live.debounce.500ms="$name"
            :with-presets="$type === 'date-range'"
            with-today
        />
    @else
        <flux:date-picker
            :$disabled
            :$max
            :$min
            :mode="$type === 'date' ? 'single' : 'range'"
            :$placeholder
            :$required
            selectable-header
            start-day="1"
            :wire:model="$name"
            :with-presets="$type === 'date-range'"
            with-today
        />
    @endif

    <flux:error class="mt-0!" :$name />

    @if ($description)
        <flux:description class="mt-0!">{!! $description !!}</flux:description>
    @endif
</flux:field>
