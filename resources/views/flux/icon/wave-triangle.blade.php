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
<svg {{ $attributes->class($classes) }} data-flux-icon aria-hidden="true" viewBox="0 0 640 512" fill="currentColor">
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M176.1 32c5.2 0 10.1 2.6 13 6.9L464.2 436.2 611 230.7c5.1-7.2 15.1-8.9 22.3-3.7s8.9 15.1 3.7 22.3l-160 224c-3 4.2-7.9 6.7-13.1 6.7s-10.1-2.6-13-6.9L175.8 75.8 29 281.3c-5.1 7.2-15.1 8.9-22.3 3.7s-8.9-15.1-3.7-22.3l160-224c3-4.2 7.9-6.7 13.1-6.7z"/>
</svg>
