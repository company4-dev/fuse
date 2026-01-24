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
<svg {{ $attributes->class($classes) }} data-flux-icon aria-hidden="true" viewBox="0 0 384 512" fill="currentColor">
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M203.3 475.3c-6.2 6.2-16.4 6.2-22.6 0l-128-128c-6.2-6.2-6.2-16.4 0-22.6s16.4-6.2 22.6 0L176 425.4 176 320l0-176c0-8.8 7.2-16 16-16s16 7.2 16 16l0 176 0 105.4L308.7 324.7c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6l-128 128zM16 64C7.2 64 0 56.8 0 48s7.2-16 16-16l352 0c8.8 0 16 7.2 16 16s-7.2 16-16 16L16 64z"/>
</svg>
