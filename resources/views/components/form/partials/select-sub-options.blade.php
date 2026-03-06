@props(['options'])

@foreach ($options as $val => $text)
    @if (is_array($text))
        <flux:select.option class="font-bold text-gray-500" disabled>
            {!! implode('', array_pad([], $level, '-&nbsp;&nbsp;&nbsp;')) !!}{{ $val }}
        </flux:select.option>
        @include(
            'components.form.partials.select-sub-options',
            [
                'level'   => $level + 1,
                'options' => $text,
            ]
        )
    @else
        <flux:select.option :label="null" :value="$val" :wire:key="$val">
            {!! implode('', array_pad([], $level, '-&nbsp;&nbsp;&nbsp;')) !!}{!! $text !!}
        </flux:select.option>
    @endif
@endforeach
