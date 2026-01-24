@php
    $attributes = $unescapedForwardedAttributes ?? $attributes;
@endphp

@props([
    'variant' => 'outline',
])

@php
    $classes = Flux::classes('shrink-0')
        ->add(match($variant) {
            'outline' => '[:where(&)]:size-6',
            'solid' => '[:where(&)]:size-6',
            'mini' => '[:where(&)]:size-5',
            'micro' => '[:where(&)]:size-4',
        });
@endphp
{{-- Your SVG code here: --}}
<svg {{ $attributes->class($classes) }} data-flux-icon aria-hidden="true" viewBox="0 0 320 512" fill="currentColor">
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M0 48c0-8.8 7.2-16 16-16l96 0 192 0c8.8 0 16 7.2 16 16s-7.2 16-16 16L202.5 64c28.7 23.2 48.3 57.3 52.6 96l48.9 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-48.9 0c-8 72-69 128-143.1 128l-46.1 0L249.3 451c7.2 5.1 8.9 15.1 3.7 22.3s-15.1 8.9-22.3 3.7L6.7 317C1 313-1.4 305.7 .8 299.1S9 288 16 288l96 0c56.4 0 103.1-41.7 110.9-96L16 192c-8.8 0-16-7.2-16-16s7.2-16 16-16l206.9 0c-7.8-54.3-54.4-96-110.9-96L16 64C7.2 64 0 56.8 0 48z"/>
</svg>
