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
<svg {{ $attributes->class($classes) }} data-flux-icon aria-hidden="true" viewBox="0 0 448 512" fill="currentColor">
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M96.8 160C61.2 160 32 188.8 32 224l0 96c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-96c0-53.2 43.9-96 96.8-96c29.4 0 57.6 13.5 75.9 36.7l128 162.8c12.1 15.4 31 24.5 50.7 24.5c35.5 0 64.8-28.8 64.8-64l0-96c0-8.8 7.2-16 16-16s16 7.2 16 16l0 96c0 53.2-43.9 96-96.8 96c-29.4 0-57.6-13.5-75.9-36.7l-128-162.9c-12.1-15.4-31-24.5-50.7-24.5z"/>
</svg>
