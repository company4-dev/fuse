<?php

declare(strict_types=1);

namespace App\View\Components\Form;

use App\Traits\InputComponent;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Radio extends Component
{
    use InputComponent;

    public bool $hidden         = false;
    public bool $required       = false;
    public string $component    = '';
    public ?string $description = null;
    public string $wrap_class   = 'mb-5';
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
