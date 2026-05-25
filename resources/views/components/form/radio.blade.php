<flux:radio.group class="{{ $wrap_class }}" :$hidden :wire:model.live.change="$name">
    <flux:label :badge="$required ? ___('dictionary.required') : null" class="mb-2!">{{ $label }}</flux:label>

    @foreach ($options as $val => $text)
        @if (is_array($text))
            <flux:radio
                :description="($text['description'] ?? false) ? ___($text['description']) : null"
                :label="___($text['label'])"
                :value="$val"
            />
        @else
            <flux:radio :label="___($text)" :value="$val" />
        @endif
    @endforeach

    <flux:error class="mt-0!" :$name />

    @if ($description)
        <flux:description class="mt-0!">{!! $description !!}</flux:description>
    @endif
</flux:radio.group>
