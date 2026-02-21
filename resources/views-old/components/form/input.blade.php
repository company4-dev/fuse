<flux:field class="mb-5" :$hidden>
    <flux:label :badge="$required ? ___('dictionary.required') : null">{{ $label }}</flux:label>

    <flux:input.group>
        @if ($prefix)
            <flux:input.group.prefix>{{ ___($prefix) }}</flux:input.group.prefix>
        @endif

        @if ($modifier === 'blur')
            <flux:input
                :$disabled
                :$placeholder
                :$max
                :$min
                :$required
                :$step
                :$type
                :$value
                :viewable="$type === 'password'"
                :wire:model.blur="$name"
            />
        @elseif ($modifier === 'live')
            <flux:input
                :$disabled
                :$placeholder
                :$max
                :$min
                :$required
                :$step
                :$type
                :$value
                :viewable="$type === 'password'"
                :wire:model.live.debounce.500ms="$name"
            />
        @else
            <flux:input
                :$disabled
                :$placeholder
                :$max
                :$min
                :$required
                :$step
                :$type
                :$value
                :viewable="$type === 'password'"
                :wire:model="$name"
            />
        @endif

        @if ($suffix)
            <flux:input.group.suffix>{{ ___($suffix) }}</flux:input.group.suffix>
        @endif
    </flux:input.group>

    <flux:error class="mt-0!" :$name />

    @if ($description)
        <flux:description class="mt-0!">{!! $description !!}</flux:description>
    @endif
</flux:field>
