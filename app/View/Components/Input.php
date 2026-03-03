<?php

namespace App\View\Components;

use Closure;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Input extends Component
{
    public $help;
    public $id;
    public $is_component;
    public $label;
    public $name;
    public $type;
    public $placeholder;
    public $required;
    public $value;

    public function __construct(array $field)
    {
        $field = array_merge(
            [
                'autofocus'    => false,
                'help'         => null,
                'is_component' => false,
                'required'     => false,
            ],
            $field,
        );

        $required = [
            'label',
            'name',
            'type',
        ];

        if (!$field['is_component']) {
            foreach ($required as $attribute) {
                if (!array_key_exists($attribute, $field)) {
                    throw new Exception(Str::headline($attribute).' is required.');
                }
            }

            if (!in_array($field['type'], ['email', 'password', 'text'])) {
                throw new Exception('Input type `'.$field['type'].'` does not exist');
            }

            foreach ($field as $attribute => $value) {
                if (array_key_exists($attribute, get_class_vars(self::class))) {
                    if ($attribute === 'label') {
                        $value = __($value);
                    }

                    $this->$attribute = $value;
                }
            }

            if ($this->placeholder === null) {
                $this->placeholder = $this->label;
            }
        }
    }

    public function render(): View|Closure|string
    {
        return view('components.input');
    }
}
