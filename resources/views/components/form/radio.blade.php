@if (count($options) === 1)
    <flux:field class="mb-5" :$hidden>
        <flux:label :badge="$required ? ___('dictionary.required') : null">{{ $label }}</flux:label>

        <flux:radio :label="___($options[key($options)])" :wire:model.change="$name" />

        <flux:error class="mt-0!" :$name />

        @if ($description)
            <flux:description class="mt-0!">{!! $description !!}</flux:description>
        @endif
    </flux:field>
@else
    <flux:radio.group class="mb-5" :$hidden :wire:model.change="$name">
        <flux:label :badge="$required ? ___('dictionary.required') : null" class="mb-2!">{{ $label }}</flux:label>

        @foreach ($options as $val => $text)
            <flux:radio :label="___($text)" :value="$val" />
        @endforeach

        <flux:error class="mt-0!" :$name />

        @if ($description)
            <flux:description class="mt-0!">{!! $description !!}</flux:description>
        @endif
    </flux:radio.group>
@endif
