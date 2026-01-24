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
<svg {{ $attributes->class($classes) }} data-flux-icon aria-hidden="true" viewBox="0 0 320 512" fill="currentColor">
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M48 64l128 0c61.9 0 112 50.1 112 112s-50.1 112-112 112L32 288 32 80c0-8.8 7.2-16 16-16zM32 320l144 0c79.5 0 144-64.5 144-144s-64.5-144-144-144L48 32C21.5 32 0 53.5 0 80L0 304 0 464c0 8.8 7.2 16 16 16s16-7.2 16-16l0-144z"/>
</svg>
