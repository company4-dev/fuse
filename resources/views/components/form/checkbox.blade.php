@if (count($options) === 1)
    @php ($option = $options[key($options)])
    <flux:field class="mb-5" :$hidden>
        <flux:label :badge="$required ? ___('dictionary.required') : null">{{ $label }}</flux:label>

        @if (is_array($option) && array_key_exists('label', $option))
            <flux:checkbox
                :checked="$option['checked'] ?? false"
                :description="array_key_exists('description', $option) ? ___($option['description']) : null"
                :disabled="$option['disabled'] ?? false"
                :label="___($option['label'])"
                :value="$val"
            />
        @else
            <flux:checkbox :label="___($option)" :wire:model.change="$name" />
        @endif

        <flux:error class="mt-0!" :$name />

        @if ($description)
            <flux:description class="mt-0!">{!! $description !!}</flux:description>
        @endif
    </flux:field>
@else
    <flux:checkbox.group :$hidden :wire:model.change="$name">
        <flux:label :badge="$required ? ___('dictionary.required') : null" class="mb-2!">{{ $label }}</flux:label>

        @foreach ($options as $val => $text)
            @if (is_array($text) && array_key_exists('label', $text))
                <flux:checkbox
                    :checked="$text['checked'] ?? false"
                    :description="array_key_exists('description', $text) ? ___($text['description']) : null"
                    :disabled="$text['disabled'] ?? false"
                    :label="___($text['label'])"
                    :value="$val"
                />
            @else
                <flux:checkbox :label="___($text)" :value="$val" />
            @endif
        @endforeach

        <flux:error class="mt-0!" :$name />

        @if ($description)
            <flux:description class="mt-0!">{!! $description !!}</flux:description>
        @endif
    </flux:checkbox.group>
@endif
