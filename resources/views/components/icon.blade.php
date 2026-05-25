@use(App\Helpers\Icons)

@props([
    'icon',
    'size' => null,
])

<flux:icon
    :class="($class ?? '').($size ? ' size-'.$size : '')"
    :icon="$icon ?? Icons::file_icon($fileExtension ?? null)"
/>
