<?php

use App\Traits\BaseInputComponent;
use Livewire\Component;

// We have to use class-style for forms to use the traits
new class extends Component
{
    use BaseInputComponent;

    public array $field;
    public bool $multiple;
    public bool $required;
    public string $callback;
    public ?string $description = null;
    public string $label;
    public string $name;
    public string $placeholder;
    public $form;
    public $search = '';

    public function mount(array $field, $form)
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

    #[\Livewire\Attributes\Computed]
    public function options()
    {
        return $this->form->{$this->callback}($this->search);
    }
};

?>

<flux:field class="mb-5">
    <flux:label :badge="$required ? ___('dictionary.required') : null">{{ ___($label) }}</flux:label>

    <flux:select
        clearable
        :filter="false"
        :multiple="$multiple"
        :placeholder="___($placeholder)"
        variant="combobox"
        :wire:model="$name"
    >
        <x-slot name="input">
            <flux:select.input wire:model.live="search" />
        </x-slot>

        @foreach ($this->options as $val => $text)
            <flux:select.option :value="$val" :wire:key="$val">{!! ___($text) !!}</flux:select.option>
        @endforeach
    </flux:select>

    <flux:error name="{{ $name }}" />

    @if ($description)
        <flux:description>{{ ___($description) }}</flux:description>
    @endif
</flux:field>
