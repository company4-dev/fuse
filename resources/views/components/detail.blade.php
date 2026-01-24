@props([
    'icon',
    'label',
    'value',
])

<div class="flex">
    <flux:icon class="mt-1" :name="$icon" size="xs" variant="micro" />

    <div class="ml-3">
        <dt><strong>{{ $label }}</strong></dt>
        <dd>{{ $value }}</dd>
    </div>
</div>
