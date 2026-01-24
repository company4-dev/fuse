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
<svg {{ $attributes->class($classes) }} data-flux-icon aria-hidden="true" viewBox="0 0 512 512" fill="currentColor">
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M292.7 196.7c-6.2 6.2-6.2 16.4 0 22.6s16.4 6.2 22.6 0L480 54.6 480 160c0 8.8 7.2 16 16 16s16-7.2 16-16l0-144c0-8.8-7.2-16-16-16L352 0c-8.8 0-16 7.2-16 16s7.2 16 16 16l105.4 0L292.7 196.7zM219.3 315.3c6.2-6.2 6.2-16.4 0-22.6s-16.4-6.2-22.6 0L32 457.4 32 352c0-8.8-7.2-16-16-16s-16 7.2-16 16L0 496c0 8.8 7.2 16 16 16l144 0c8.8 0 16-7.2 16-16s-7.2-16-16-16L54.6 480 219.3 315.3z"/>
</svg>
