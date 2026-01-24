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
    <path style="opacity:0.4" d="M37.6 256L256 97.9l0 316.2L37.6 256zM288 236.9l192-139 0 316.2-192-139 0-38.2z"/><path class="fa-primary" d="M37.6 256L256 414.1l0-316.2L37.6 256zM258 64c16.6 0 30 13.5 30 30l0 103.4L464.3 69.7C469.5 66 475.6 64 482 64c16.6 0 30 13.5 30 30L512 418c0 16.6-13.4 30-30 30c-6.3 0-12.5-2-17.6-5.7L288 314.6 288 418c0 16.6-13.5 30-30 30c-6.3 0-12.5-2-17.6-5.7L9.9 275.4C3.7 270.9 0 263.7 0 256s3.7-14.9 9.9-19.4L240.3 69.7C245.5 66 251.6 64 258 64zm30 211.1l192 139 0-316.2-192 139 0 38.2z"/>
</svg>
