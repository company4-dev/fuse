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
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M174.3 55.2c4-7.9 .7-17.5-7.2-21.5s-17.5-.7-21.5 7.2l-144 288c-2.5 5-2.2 10.9 .7 15.6s8.1 7.6 13.6 7.6l272 0 0 112c0 8.8 7.2 16 16 16s16-7.2 16-16l0-112 48 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-48 0 0-176c0-8.8-7.2-16-16-16s-16 7.2-16 16l0 176L41.9 320 174.3 55.2z"/>
</svg>
