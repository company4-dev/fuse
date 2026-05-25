@props([
    'icon',
    'label',
    'value',
])

<div class="flex">
    <x-icon class="mt-1" :icon="$icon" />

    <div class="ml-3">
        <dt class="text-xs"><strong>{{ $label }}</strong></dt>
        <dd>{{ $value }}</dd>
    </div>
</div>
