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
<svg {{ $attributes->class($classes) }} data-flux-icon aria-hidden="true" viewBox="0 0 576 512" fill="currentColor">
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M16 64l544 0c8.8 0 16-7.2 16-16s-7.2-16-16-16L16 32C7.2 32 0 39.2 0 48s7.2 16 16 16zM4.7 228.7c-6.2 6.2-6.2 16.4 0 22.6s16.4 6.2 22.6 0L112 166.6 112 464c0 8.8 7.2 16 16 16s16-7.2 16-16l0-297.4 84.7 84.7c6.2 6.2 16.4 6.2 22.6 0s6.2-16.4 0-22.6l-112-112c-6.2-6.2-16.4-6.2-22.6 0l-112 112zm320 22.6c6.2 6.2 16.4 6.2 22.6 0L432 166.6 432 464c0 8.8 7.2 16 16 16s16-7.2 16-16l0-297.4 84.7 84.7c6.2 6.2 16.4 6.2 22.6 0s6.2-16.4 0-22.6l-112-112c-6.2-6.2-16.4-6.2-22.6 0l-112 112c-6.2 6.2-6.2 16.4 0 22.6z"/>
</svg>
