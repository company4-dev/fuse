<?php

declare(strict_types=1);

use App\Extensions\Livewire\Component;
use App\Traits\InputComponent;
use Livewire\Attributes\Computed;

// We have to use class-style for forms to use the traits
new class extends Component
{
    use InputComponent;

    public array $field;
    public bool $autofocus;
    public bool $multiple;
    public bool $required;
    public string $callback;
    public ?string $description = null;
    public string $label;
    public string $name;
    public string $placeholder;
    public ?string $search      = null;
    public string $wrap_class   = 'mb-5';
    public ?string $x_on_change = null;
    public $form;

    public function mount(array $field, $form): void
    {
        $this->validate_attributes(
            $field,
            [
                'callback',
                'label',
            ]
        );

        $this->form = $form;

        foreach ($field as $attribute => $value) {
            $this->$attribute = $value;
        }
    }

    #[Computed]
    public function options()
    {
        $this->form->{$this->name} = $this->search;

        return $this->search === null ? [] : $this->form->{$this->callback}();
    }
};

?>

<flux:field class="{{ $wrap_class }}">
    <flux:label :badge="$required ? ___('dictionary.required') : null">{{ ___($label) }}</flux:label>

    <flux:select
        clearable
        :filter="false"
        :multiple="$multiple"
        :placeholder="___($placeholder)"
        variant="combobox"
        :x-on:change="$x_on_change"
    >
        <x-slot name="input">
            <flux:select.input :$autofocus wire:model.live.debounce="search" />
        </x-slot>

        @foreach ($this->options as $val => $text)
            <flux:select.option :value="$val" :wire:key="$val">
                @if (is_array($text))
                    <div class="flex items-center gap-2">
                        @if (array_key_exists('icon', $text))
                            <x-icon class="text-zinc-400" :icon="$text['icon']" />
                        @endif
                        {!! ___($text['label']) !!}
                    </div>
                @else
                    {!! ___($text) !!}
                @endif
            </flux:select.option>
        @endforeach
    </flux:select>

    <flux:error name="{{ $name }}" />

    @if ($description)
        <flux:description>{{ ___($description) }}</flux:description>
    @endif
</flux:field>
