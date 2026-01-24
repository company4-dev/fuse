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
    <path style="opacity:0.4" d="M109.3 86.7L256 233.4 402.7 86.7C363.4 52.6 312.1 32 256 32s-107.4 20.6-146.7 54.7zm0 338.6C148.6 459.4 199.9 480 256 480s107.4-20.6 146.7-54.7L256 278.6 109.3 425.3z"/><path class="fa-primary" d="M402.7 425.3L256 278.6 109.3 425.3C148.6 459.4 199.9 480 256 480s107.4-20.6 146.7-54.7zm22.6-22.6C459.4 363.4 480 312.1 480 256s-20.6-107.4-54.7-146.7L278.6 256 425.3 402.7zm-22.6-316C363.4 52.6 312.1 32 256 32s-107.4 20.6-146.7 54.7L256 233.4 402.7 86.7zm-316 22.6C52.6 148.6 32 199.9 32 256s20.6 107.4 54.7 146.7L233.4 256 86.7 109.3zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256z"/>
</svg>
