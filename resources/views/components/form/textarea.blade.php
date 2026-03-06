<flux:field class="mb-5" :$hidden>
    <flux:label :badge="$required ? ___('dictionary.required') : null">{{ $label }}</flux:label>

    @if ($modifier === 'blur')
        <flux:textarea :$disabled :$placeholder :$required rows="auto" :wire:model.blur="$name" />
    @elseif ($modifier === 'live')
        <flux:textarea :$disabled :$placeholder :$required rows="auto" :wire:model.live.debounce.500ms="$name" />
    @else
        <flux:textarea :$disabled :$placeholder :$required rows="auto" :wire:model="$name" />
    @endif

    <flux:error class="mt-0!" :$name />

    @if ($description)
        <flux:description class="mt-0!">{!! $description !!}</flux:description>
    @endif
</flux:field>
