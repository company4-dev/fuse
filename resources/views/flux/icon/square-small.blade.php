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
    <path style="opacity:0.4" d="M32 160l0 192c0 17.7 14.3 32 32 32l192 0c17.7 0 32-14.3 32-32l0-192c0-17.7-14.3-32-32-32L64 128c-17.7 0-32 14.3-32 32z"/><path class="fa-primary" d="M256 128c17.7 0 32 14.3 32 32l0 192c0 17.7-14.3 32-32 32L64 384c-17.7 0-32-14.3-32-32l0-192c0-17.7 14.3-32 32-32l192 0zM64 96C28.7 96 0 124.7 0 160L0 352c0 35.3 28.7 64 64 64l192 0c35.3 0 64-28.7 64-64l0-192c0-35.3-28.7-64-64-64L64 96z"/>
</svg>
