<?php

declare(strict_types=1);

namespace App\View\Components\Form;

use App\Enums\Components\Form\Mime;
use App\Helpers\Conversions;
use App\Helpers\Formatters;
use App\Traits\InputComponent;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Number;
use Illuminate\View\Component;

class File extends Component
{
    use InputComponent;

    public bool $can_add;
    public bool $can_delete;
    public bool $hidden = false;
    public bool $is_component;
    public bool $is_livewire;
    public Mime|string $accepts;
    public string $component    = '';
    public ?string $description = null;
    public string $wrap_class   = 'mb-5';
    public $files;
    public $id;
    public $label;
    public $multiple;
    public $name;
    public $type;
    public $placeholder;
    public $required;
    public $value;

    public function __construct(array $field)
    {
        $this->validate_attributes(
            $field,
            [
                'accepts',
                'label',
            ],
            [
                'can_add'    => true,
                'can_delete' => true,
            ]
        );

        $this->accepts = ___(
            'messages.components.form.file.accepts',
            [
                Formatters::implode(', ', ' '.___('dictionary.and').' ', $this->accepts->extensions()),
                Number::fileSize(Conversions::ini_size_to_bytes(ini_get('upload_max_filesize'))),
            ]
        );
    }

    public function render(): View|Closure|string
    {
        return view('components.form.file');
    }
}
