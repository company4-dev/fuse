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
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M0 48c0-8.8 7.2-16 16-16l128 0c8.8 0 16 7.2 16 16s-7.2 16-16 16L96 64l0 160c0 70.7 57.3 128 128 128s128-57.3 128-128l0-160-48 0c-8.8 0-16-7.2-16-16s7.2-16 16-16l128 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-48 0 0 160c0 88.4-71.6 160-160 160s-160-71.6-160-160L64 64 16 64C7.2 64 0 56.8 0 48zM0 464c0-8.8 7.2-16 16-16l416 0c8.8 0 16 7.2 16 16s-7.2 16-16 16L16 480c-8.8 0-16-7.2-16-16z"/>
</svg>
