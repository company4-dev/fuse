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
    <path style="opacity:0.4" d="M80 176a16 16 0 1 1 -32 0 16 16 0 1 1 32 0zm0 160a16 16 0 1 1 -32 0 16 16 0 1 1 32 0zM240 176a16 16 0 1 1 -32 0 16 16 0 1 1 32 0zm0 160a16 16 0 1 1 -32 0 16 16 0 1 1 32 0zM400 176a16 16 0 1 1 -32 0 16 16 0 1 1 32 0zm0 160a16 16 0 1 1 -32 0 16 16 0 1 1 32 0z"/><path class="fa-primary" d="M384 192a16 16 0 1 0 0-32 16 16 0 1 0 0 32zm0-64a48 48 0 1 1 0 96 48 48 0 1 1 0-96zM224 192a16 16 0 1 0 0-32 16 16 0 1 0 0 32zm0-64a48 48 0 1 1 0 96 48 48 0 1 1 0-96zM48 176a16 16 0 1 0 32 0 16 16 0 1 0 -32 0zm64 0a48 48 0 1 1 -96 0 48 48 0 1 1 96 0zM384 352a16 16 0 1 0 0-32 16 16 0 1 0 0 32zm0-64a48 48 0 1 1 0 96 48 48 0 1 1 0-96zM208 336a16 16 0 1 0 32 0 16 16 0 1 0 -32 0zm64 0a48 48 0 1 1 -96 0 48 48 0 1 1 96 0zM64 352a16 16 0 1 0 0-32 16 16 0 1 0 0 32zm0-64a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/>
</svg>
