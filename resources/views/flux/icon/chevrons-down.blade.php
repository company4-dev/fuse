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
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M52.7 75.3l192 192c6.2 6.2 16.4 6.2 22.6 0l192-192c6.2-6.2 6.2-16.4 0-22.6s-16.4-6.2-22.6 0L256 233.4 75.3 52.7c-6.2-6.2-16.4-6.2-22.6 0s-6.2 16.4 0 22.6zm0 192l192 192c6.2 6.2 16.4 6.2 22.6 0l192-192c6.2-6.2 6.2-16.4 0-22.6s-16.4-6.2-22.6 0L256 425.4 75.3 244.7c-6.2-6.2-16.4-6.2-22.6 0s-6.2 16.4 0 22.6z"/>
</svg>
