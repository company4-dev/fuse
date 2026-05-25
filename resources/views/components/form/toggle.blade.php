<!-- Egg #3: On point -->
<flux:field class="{{ $wrap_class }}" :$hidden>
    <flux:label :badge="$required ? ___('dictionary.required') : null">{{ $label }}</flux:label>

    @if ($modifier === 'change')
        <flux:switch
            :$required
            :wire:model.live.change="$name"
        />
    @else
        <flux:switch
            :$required
            :wire:model="$name"
        />
    @endif

    <flux:error class="mt-0!" :$name />

    @if ($description)
        <flux:description class="mt-0!">{!! $description !!}</flux:description>
    @endif
</flux:field>
