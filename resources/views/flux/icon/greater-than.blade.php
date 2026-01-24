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
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M1.7 72.8c-4 7.9-.7 17.5 7.2 21.5L332.2 256 8.8 417.7c-7.9 4-11.1 13.6-7.2 21.5s13.6 11.1 21.5 7.2l352-176c5.4-2.7 8.8-8.3 8.8-14.3s-3.4-11.6-8.8-14.3l-352-176c-7.9-4-17.5-.7-21.5 7.2z"/>
</svg>
