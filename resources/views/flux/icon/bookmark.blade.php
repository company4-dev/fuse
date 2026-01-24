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
    <path style="opacity:0.4" d="M32 48l0 423.4L183.1 370.7c5.4-3.6 12.4-3.6 17.8 0L352 471.4 352 48c0-8.8-7.2-16-16-16L48 32c-8.8 0-16 7.2-16 16z"/><path class="fa-primary" d="M0 48C0 21.5 21.5 0 48 0L336 0c26.5 0 48 21.5 48 48l0 441.9c0 12.2-9.9 22.1-22.1 22.1c-4.4 0-8.6-1.3-12.3-3.7L192 403.2 34.4 508.3c-3.6 2.4-7.9 3.7-12.3 3.7C9.9 512 0 502.1 0 489.9L0 48zM32 471.4L183.1 370.7c5.4-3.6 12.4-3.6 17.8 0L352 471.4 352 48c0-8.8-7.2-16-16-16L48 32c-8.8 0-16 7.2-16 16l0 423.4z"/>
</svg>
