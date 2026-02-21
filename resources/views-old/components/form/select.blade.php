<flux:field class="mb-5" :$hidden>
    <flux:label :badge="$required ? ___('dictionary.required') : null">{{ $label }}</flux:label>

    @if ($modifier === 'change')
        <flux:select
            clearable
            :$multiple
            :$placeholder
            :$required
            searchable
            variant="listbox"
            :wire:model.change="$name"
        >
            @include(
                'components.form.partials.select-options',
                [
                    'level'   => 1,
                    'options' => $options,
                ]
            )
        </flux:select>
    @else
        <flux:select
            clearable
            :$multiple
            :$placeholder
            :$required
            searchable
            variant="listbox"
            :wire:model="$name"
        >
            @include(
                'components.form.partials.select-options',
                [
                    'level'   => 1,
                    'options' => $options,
                ]
            )
        </flux:select>
    @endif

    <flux:error class="mt-0!" :$name />

    @if ($description)
        <flux:description class="mt-0!">{!! $description !!}</flux:description>
    @endif
</flux:field>
