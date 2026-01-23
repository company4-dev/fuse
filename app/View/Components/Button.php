<?php

namespace Fuse\View\Components;

use Closure;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Button extends Component
{
    public bool $hidden = false;
    public $label;
    public $name;
    public $type;
    public $variant;

    public function __construct(array $action)
    {
        $action = array_merge(
            [
            ],
            $action,
        );

        $required = [
            'label',
            'name',
            'type',
        ];

        foreach ($required as $attribute) {
            if (!array_key_exists($attribute, $action)) {
                throw new Exception(___('errors.components.button.attribute-required', [Str::headline($attribute)]));
            }
        }

        if ($action['type'] != 'submit') {
            throw new Exception(___('errors.components.button.invalid-type', [$action['type']]));
        }

        foreach ($action as $attribute => $value) {
            if (array_key_exists($attribute, get_class_vars(self::class))) {
                if ($attribute === 'label') {
                    $value = ___($value);
                }

                $this->$attribute = $value;
            }
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.button');
    }
}
