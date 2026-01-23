<?php

namespace Fuse\View\Components\Form;

use Closure;
use Fuse\Traits\BaseInputComponent;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Date extends Component
{
    use BaseInputComponent;

    public bool $disabled       = false;
    public bool $hidden         = false;
    public bool $is_component   = false;
    public bool $required       = false;
    public ?string $description = '';
    public $id;
    public $label;
    public $max;
    public $min;
    public $modifier;
    public $name;
    public $prefix;
    public $suffix;
    public $type;
    public $placeholder;
    public $value;

    public function __construct(array $field)
    {
        $this->validate_attributes(
            $field,
            [
                'label',
            ]
        );
    }

    public function render(): View|Closure|string
    {
        return view('components.form.date');
    }
}
