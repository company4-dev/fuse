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
    <path style="opacity:0.4" d="M224 256A64 64 0 1 1 96 256a64 64 0 1 1 128 0z"/><path class="fa-primary" d="M416 128c70.7 0 128 57.3 128 128s-57.3 128-128 128l-256 0C89.3 384 32 326.7 32 256s57.3-128 128-128l256 0zM576 256c0-88.4-71.6-160-160-160L160 96C71.6 96 0 167.6 0 256s71.6 160 160 160l256 0c88.4 0 160-71.6 160-160zm-352 0A64 64 0 1 1 96 256a64 64 0 1 1 128 0zM64 256a96 96 0 1 0 192 0A96 96 0 1 0 64 256z"/>
</svg>
