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
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M16 32c8.8 0 16 7.2 16 16l0 240c0 88.4 71.6 160 160 160s160-71.6 160-160l0-240c0-8.8 7.2-16 16-16s16 7.2 16 16l0 240c0 106-86 192-192 192S0 394 0 288L0 48c0-8.8 7.2-16 16-16z"/>
</svg>
