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
    <path style="opacity:0.4" d="M32 256c0 81.5 43.5 152.9 108.6 192c-13.1-20.9-20.6-45.6-20.6-72c0-75.1 60.9-136 136-136c57.4 0 104-46.6 104-104s-46.6-104-104-104C132.3 32 32 132.3 32 256zM280 136a24 24 0 1 1 -48 0 24 24 0 1 1 48 0z"/><path class="fa-primary" d="M480 256c0 123.7-100.3 224-224 224c-57.4 0-104-46.6-104-104s46.6-104 104-104c75.1 0 136-60.9 136-136c0-26.5-7.6-51.2-20.6-72C436.5 103.1 480 174.5 480 256zM256 32c57.4 0 104 46.6 104 104s-46.6 104-104 104c-75.1 0-136 60.9-136 136c0 26.5 7.6 51.2 20.6 72C75.5 408.9 32 337.5 32 256C32 132.3 132.3 32 256 32zm0 480A256 256 0 1 0 256 0a256 256 0 1 0 0 512zm24-136a24 24 0 1 0 -48 0 24 24 0 1 0 48 0zM256 160a24 24 0 1 0 0-48 24 24 0 1 0 0 48z"/>
</svg>
