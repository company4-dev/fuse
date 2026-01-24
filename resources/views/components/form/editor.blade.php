<flux:field class="mb-5" :$hidden>
    <flux:label :badge="$required ? ___('dictionary.required') : null">{{ $label }}</flux:label>

    @if ($modifier === 'blur')
        <flux:editor
            class="**:data-[slot=content]:min-h-[75px]! **:data-[slot=content]:max-h-[400px]!"
            :$disabled
            :$placeholder
            :wire:model.blur="$name"
        />
    @elseif ($modifier === 'live')
        <flux:editor
            class="**:data-[slot=content]:min-h-[75px]! **:data-[slot=content]:max-h-[400px]!"
            :$disabled
            :$placeholder
            :wire:model.live.debounce.500ms="$name"
        />
    @else
        <flux:editor
            class="**:data-[slot=content]:min-h-[75px]! **:data-[slot=content]:max-h-[400px]!"
            :$disabled
            :$placeholder
            :wire:model="$name"
        />
    @endif

    <flux:error class="mt-0!" :$name />

    @if ($description)
        <flux:description class="mt-0!">{!! $description !!}</flux:description>
    @endif
</flux:field>
