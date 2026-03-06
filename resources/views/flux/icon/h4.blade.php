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
<svg {{ $attributes->class($classes) }} data-flux-icon aria-hidden="true" viewBox="0 0 640 512" fill="currentColor">
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M447.7 83L411.4 272 608 272l0-192c0-8.8 7.2-16 16-16s16 7.2 16 16l0 352c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-128-216 0c-4.8 0-9.3-2.1-12.3-5.8s-4.3-8.5-3.4-13.2l40-208c1.7-8.7 10.1-14.4 18.7-12.7s14.4 10.1 12.7 18.7zM16 64c8.8 0 16 7.2 16 16l0 160 256 0 0-160c0-8.8 7.2-16 16-16s16 7.2 16 16l0 176 0 176c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-160L32 272l0 160c0 8.8-7.2 16-16 16s-16-7.2-16-16L0 256 0 80c0-8.8 7.2-16 16-16z"/>
</svg>
