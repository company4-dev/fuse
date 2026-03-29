@php
    $classes = [
        'gap-4',
        'grid',
        $class ?? '',
    ];

    if (!isset($cols)) {
        $cols = 5;
    }

    $cols = min((int) $cols, 5);

    if ($cols === 5) {
        $classes[] = 'sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xxl:grid-cols-5';
    } elseif ($cols === 4) {
        $classes[] = 'sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xxl:grid-cols-4';
    } elseif ($cols === 3) {
        $classes[] = 'sm:grid-cols-2 md:grid-cols-2 xxl:grid-cols-3';
    } elseif ($cols === 2) {
        $classes[] = 'sm:grid-cols-2';
    }
@endphp

<div class="{{ implode(' ', $classes) }}">
    {!! $slot !!}
</div>
