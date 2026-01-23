<?php

namespace Fuse\View\Components\Form;

use Closure;
use Fuse\Helpers\Schedule as ScheduleHelper;
use Fuse\Traits\BaseInputComponent;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use InvalidArgumentException;

class Schedule extends Component
{
    use BaseInputComponent;

    public $alpine_data;
    public $fields;
    public ?string $description = null;
    public $id;
    public $is_component;
    public $label;
    public $multiple;
    public $name;
    public $nth = [];
    public $placeholder;
    public $prefix;
    public $required;
    public $suffix;
    public $time;
    public $type;
    public $value;

    public function __construct(array $field)
    {
        $this->validate_attributes(
            $field,
            [
                'label',
            ],
            [
                'time' => true,
            ]
        );

        $this->alpine_data = json_encode([
            'alpine_end_type'          => null,
            'alpine_recurrence'        => null,
            'alpine_recurrence_type_1' => null, // Daily
            // 'alpine_recurrence_type_2'       // Not it use as Weekly doesn't need it
            'alpine_recurrence_type_3' => null, // Monthly
            'alpine_recurrence_type_4' => null, // Yearly
        ]);

        $this->fields = ScheduleHelper::fields($field);
    }

    public function render(): View|Closure|string
    {
        return view('components.form.schedule');
    }

    private function validate_attribute_time($field, $value): bool
    {
        if (!is_bool($value)) {
            throw new InvalidArgumentException(___('errors.exceptions.components.schedule.invalid-time'));
        }

        return $value;
    }
}
