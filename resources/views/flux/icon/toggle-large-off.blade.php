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
    <path style="opacity:0.4" d="M32 256a128 128 0 1 0 256 0A128 128 0 1 0 32 256z"/><path class="fa-primary" d="M160 384a128 128 0 1 1 0-256 128 128 0 1 1 0 256zm0 32l256 0c88.4 0 160-71.6 160-160s-71.6-160-160-160L160 96C71.6 96 0 167.6 0 256s71.6 160 160 160zm96-32c38.9-29.2 64-75.7 64-128s-25.1-98.8-64-128l160 0c70.7 0 128 57.3 128 128s-57.3 128-128 128l-160 0z"/>
</svg>
