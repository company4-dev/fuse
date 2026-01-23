<?php

namespace Fuse\View\Components\Form;

use Closure;
use Fuse\Helpers\Conversions;
use Fuse\Helpers\Formatters;
use Fuse\Traits\BaseInputComponent;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Number;
use Illuminate\View\Component;

class File extends Component
{
    use BaseInputComponent;

    public bool $can_add;
    public bool $can_delete;
    public bool $hidden = false;
    public bool $is_component;
    public bool $is_livewire;
    public ?string $description = null;
    public $accepts;
    public $component;
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
                Formatters::implode(', ', ' '.___('dictionary.and').' ', $this->accepts),
                Number::fileSize(Conversions::ini_size_to_bytes(ini_get('upload_max_filesize'))),
            ]
        );
    }

    public function render(): View|Closure|string
    {
        return view('components.form.file');
    }
}
