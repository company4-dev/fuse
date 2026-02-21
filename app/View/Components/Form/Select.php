<?php

namespace App\View\Components\Form;

use Closure;
use App\Traits\BaseInputComponent;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Select extends Component
{
    use BaseInputComponent;

    public bool $hidden            = false;
    public bool $is_component      = false;
    public bool $is_livewire       = false;
    public bool $required          = false;
    public ?string $description    = null;
    public ?string $modifier       = null;
    public $component;
    public $id;
    public $label;
    public $multiple;
    public $name;
    public $options;
    public $placeholder;
    public $prefix;
    public $suffix;
    public $type;
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
        return view('components.form.select');
    }
}
