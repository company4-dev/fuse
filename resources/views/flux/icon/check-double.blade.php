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
<svg {{ $attributes->class($classes) }} data-flux-icon aria-hidden="true" viewBox="0 0 448 512" fill="currentColor">
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M331.3 75.3c6.2-6.2 6.2-16.4 0-22.6s-16.4-6.2-22.6 0L160 201.4 91.3 132.7c-6.2-6.2-16.4-6.2-22.6 0s-6.2 16.4 0 22.6l80 80c6.2 6.2 16.4 6.2 22.6 0l160-160zm112 112c6.2-6.2 6.2-16.4 0-22.6s-16.4-6.2-22.6 0L160 425.4 27.3 292.7c-6.2-6.2-16.4-6.2-22.6 0s-6.2 16.4 0 22.6l144 144c6.2 6.2 16.4 6.2 22.6 0l272-272z"/>
</svg>
