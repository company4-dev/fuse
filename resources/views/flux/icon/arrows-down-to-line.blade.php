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
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M560 448L16 448c-8.8 0-16 7.2-16 16s7.2 16 16 16l544 0c8.8 0 16-7.2 16-16s-7.2-16-16-16zm11.3-164.7c6.2-6.2 6.2-16.4 0-22.6s-16.4-6.2-22.6 0L464 345.4 464 48c0-8.8-7.2-16-16-16s-16 7.2-16 16l0 297.4-84.7-84.7c-6.2-6.2-16.4-6.2-22.6 0s-6.2 16.4 0 22.6l112 112c6.2 6.2 16.4 6.2 22.6 0l112-112zm-320-22.6c-6.2-6.2-16.4-6.2-22.6 0L144 345.4 144 48c0-8.8-7.2-16-16-16s-16 7.2-16 16l0 297.4L27.3 260.7c-6.2-6.2-16.4-6.2-22.6 0s-6.2 16.4 0 22.6l112 112c6.2 6.2 16.4 6.2 22.6 0l112-112c6.2-6.2 6.2-16.4 0-22.6z"/>
</svg>
