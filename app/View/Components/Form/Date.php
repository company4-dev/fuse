<?php

declare(strict_types=1);

namespace App\View\Components\Form;

use App\Traits\InputComponent;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Date extends Component
{
    use InputComponent;

    public bool $autofocus      = false;
    public bool $disabled       = false;
    public bool $hidden         = false;
    public bool $is_component   = false;
    public bool $required       = false;
    public string $component    = '';
    public ?string $description = '';
    public string $wrap_class   = 'mb-5';
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
