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
    <path style="opacity:0.4" d="M32 64l0 288c0 17.7 14.3 32 32 32l96 0c17.7 0 32 14.3 32 32l0 48 98.1-73.6c5.5-4.2 12.3-6.4 19.2-6.4L448 384c17.7 0 32-14.3 32-32l0-288c0-17.7-14.3-32-32-32L64 32C46.3 32 32 46.3 32 64z"/><path class="fa-primary" d="M160 384c17.7 0 32 14.3 32 32l0 48 98.1-73.6c5.5-4.2 12.3-6.4 19.2-6.4L448 384c17.7 0 32-14.3 32-32l0-288c0-17.7-14.3-32-32-32L64 32C46.3 32 32 46.3 32 64l0 288c0 17.7 14.3 32 32 32l96 0zM0 64C0 28.7 28.7 0 64 0L448 0c35.3 0 64 28.7 64 64l0 288c0 35.3-28.7 64-64 64l-138.7 0L185.6 508.8c-4.8 3.6-11.3 4.2-16.8 1.5s-8.8-8.2-8.8-14.3l0-48 0-32-32 0-64 0c-35.3 0-64-28.7-64-64L0 64z"/>
</svg>
