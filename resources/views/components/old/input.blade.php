@props(['value'])
<flux:field class="mb-3">
    <flux:label badge="{{ $required ? __('Required') : null }}">{{ $label }}</flux:label>

    <flux:input placeholder="{{ $placeholder }}" type="{{ $type }}" value="{{ $value ?? null }}" wire:model="{{ $name }}" />

    <flux:error name="{{ $name }}" />

    @if ($help)
        <flux:description>{{ $help }}</flux:description>
    @endif
</flux:field>
