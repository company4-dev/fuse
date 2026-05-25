<?php

declare(strict_types=1);

namespace App\View\Components\Form;

use App\Traits\InputComponent;
use Closure;
use Illuminate\Contracts\View\View;

class Checkbox
{
    use InputComponent;

    public bool $hidden         = false;
    public bool $multiple       = false;
    public string $component    = '';
    public ?string $description = '';
    public string $wrap_class   = 'mb-5';
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
