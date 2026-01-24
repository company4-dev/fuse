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
<svg {{ $attributes->class($classes) }} data-flux-icon aria-hidden="true" viewBox="0 0 384 512" fill="currentColor">
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M0 48c0-8.8 7.2-16 16-16l352 0c8.8 0 16 7.2 16 16s-7.2 16-16 16L16 64C7.2 64 0 56.8 0 48zM0 176c0-8.8 7.2-16 16-16l176 0 176 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-160 0 0 272c0 8.8-7.2 16-16 16s-16-7.2-16-16l0-272L16 192c-8.8 0-16-7.2-16-16z"/>
</svg>
