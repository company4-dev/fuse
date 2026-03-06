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
    <path style="opacity:0.4" d=""/><path class="fa-primary" d="M190.9 53.7c3.2-8.2-.9-17.5-9.2-20.7s-17.5 .9-20.7 9.2l-160 416c-3.2 8.2 .9 17.5 9.2 20.7s17.5-.9 20.7-9.2l160-416zm84.7-21.3c-8.6-2-17.2 3.4-19.2 12l-96 416c-2 8.6 3.4 17.2 12 19.2s17.2-3.4 19.2-12l96-416c2-8.6-3.4-17.2-12-19.2zM368 32c-8.8 0-16 7.2-16 16l0 416c0 8.8 7.2 16 16 16s16-7.2 16-16l0-416c0-8.8-7.2-16-16-16z"/>
</svg>
