<?php

namespace App\View\Components\Form;

use Closure;
use App\Traits\BaseInputComponent;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Checkbox extends Component
{
    use BaseInputComponent;

    public bool $hidden         = false;
    public bool $multiple       = false;
    public ?string $description = '';
    public $id;
    public $label;
    public $name;
    public $options;
    public $placeholder;
    public $required;
    public $type;
    public $value;

    public function __construct(array $field)
    {
        $this->validate_attributes(
            $field,
            [
                'label',
                'options',
            ]
        );
    }

    public function render(): View|Closure|string
    {
        return view('components.form.checkbox');
    }
}
