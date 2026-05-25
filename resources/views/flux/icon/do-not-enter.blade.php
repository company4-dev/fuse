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
    <path style="opacity:0.4" d="M32 256a224 224 0 1 0 448 0A224 224 0 1 0 32 256zm48-16c0-22.1 17.9-40 40-40l272 0c22.1 0 40 17.9 40 40l0 32c0 22.1-17.9 40-40 40l-272 0c-22.1 0-40-17.9-40-40l0-32z"/><path class="fa-primary" d="M480 256A224 224 0 1 0 32 256a224 224 0 1 0 448 0zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zm112-16l0 32c0 4.4 3.6 8 8 8l272 0c4.4 0 8-3.6 8-8l0-32c0-4.4-3.6-8-8-8l-272 0c-4.4 0-8 3.6-8 8zm-32 0c0-22.1 17.9-40 40-40l272 0c22.1 0 40 17.9 40 40l0 32c0 22.1-17.9 40-40 40l-272 0c-22.1 0-40-17.9-40-40l0-32z"/>
</svg>
