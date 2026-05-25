<?php

declare(strict_types=1);

namespace App\View\Components\Form;

use App\Traits\InputComponent;
use Closure;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Button extends Component
{
    use InputComponent;

    public bool $hidden = false;
    public string $component;
    public string $id;
    public $label;
    public $name;
    public $type;
    public $value;
    public $variant;

    public function __construct(array $action)
    {
        $action = array_merge(
            [
                'value' => 1,
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
                throw new Exception(___(
                    'errors.exceptions.components.button.attribute-required',
                    Str::headline($attribute)
                ));
            }
        }

        if (!in_array($action['type'], ['button', 'submit'], true)) {
            throw new Exception(___('errors.exceptions.components.button.invalid-type', $action['type']));
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
        return view('components.form.button');
    }
}
