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
    <path style="opacity:0.4" d="M32 64l88 176 322.7 0L32 64zm0 384L442.7 272 120 272 32 448z"/><path class="fa-primary" d="M3.4 78.3c-6-12-3.9-26.5 5.3-36.3s23.5-12.7 35.9-7.5l448 192c11.8 5 19.4 16.6 19.4 29.4s-7.6 24.4-19.4 29.4l-448 192c-12.3 5.3-26.7 2.3-35.9-7.5s-11.3-24.3-5.3-36.3L92.2 256 3.4 78.3zM120 272L32 448 442.7 272 120 272zm322.7-32L32 64l88 176 322.7 0z"/>
</svg>
