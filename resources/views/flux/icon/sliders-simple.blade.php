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
    <path style="opacity:0.4" d="M32 368a48 48 0 1 0 96 0 48 48 0 1 0 -96 0zM384 144a48 48 0 1 0 96 0 48 48 0 1 0 -96 0z"/><path class="fa-primary" d="M80 320a48 48 0 1 0 0 96 48 48 0 1 0 0-96zm78.4 32L496 352c8.8 0 16 7.2 16 16s-7.2 16-16 16l-337.6 0c-7.4 36.5-39.7 64-78.4 64c-44.2 0-80-35.8-80-80s35.8-80 80-80c38.7 0 71 27.5 78.4 64zM384 144a48 48 0 1 0 96 0 48 48 0 1 0 -96 0zm-30.4-16C361 91.5 393.3 64 432 64c44.2 0 80 35.8 80 80s-35.8 80-80 80c-38.7 0-71-27.5-78.4-64L16 160c-8.8 0-16-7.2-16-16s7.2-16 16-16l337.6 0z"/>
</svg>
