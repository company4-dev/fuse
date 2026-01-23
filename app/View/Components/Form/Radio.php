<?php

namespace Fuse\View\Components\Form;

use Closure;
use Fuse\Traits\BaseInputComponent;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Radio extends Component
{
    use BaseInputComponent;

    public bool $hidden         = false;
    public bool $required       = false;
    public ?string $description = null;
    public $id;
    public $label;
    public $multiple;
    public $name;
    public $options;
    public $placeholder;
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
        return view('components.form.radio');
    }
}
