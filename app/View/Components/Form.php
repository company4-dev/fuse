<?php

namespace Fuse\View\Components;

use Closure;
use Exception;
use Fuse\Helpers\Conversions;
use Fuse\Helpers\Formatters;
use Fuse\Hooks\Form as FormHook;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class Form extends Component
{
    public array $actions  = [];
    public array $sections = [];
    public $action;
    public $feature;
    public $form;
    public $platform;
    public $table;
    public $type;

    public function __construct($form, $table = null, string $type = 'default')
    {
        $accepted_types = [
            'default',
            'inline',
            'ungrouped',
        ];

        $this->form  = $form;
        $this->table = $table;
        $this->type  = in_array($type, $accepted_types)
            ? $type
            : throw new Exception(___(
                'errors.exceptions.components.form.invalid-type',
                [
                    $type,
                    Formatters::implode('", "', '" '.___('dictionary.or').' "', $accepted_types),
                ]
            ));

        $this->generate_form();
    }

    public static function normalise_fields($form, array $sections): array
    {
        $return   = [];
        $sections = FormHook::get(FormHook::Fields, $sections, $form, $form->getComponent());

        foreach ($sections as $section => $section_data) {
            $key = $section;

            if (is_numeric($key)) {
                $key = Str::headline(class_basename($form::class));
            }

            if (!array_key_exists($key, $return)) {
                $return[$key] = [
                    'description' => null,
                    'fields'      => [],
                ];
            }

            if (array_key_exists('type', $section_data)) {
                // $sections is the array of fields
                $return[$key]['fields'][] = $section_data;
            } elseif (array_key_exists('fields', $section_data)) {
                $return[$key]['description'] = $section_data['description'] ?? null;
                $return[$key]['fields']      = $section_data['fields'];
            } else {
                $return[$key]['fields'] = $section_data;
            }
        }

        return $return;
    }

    public function render(): View|Closure|string
    {
        return view('components.form');
    }

    private function generate_form(): void
    {
        $i        = 0;
        $sections = self::normalise_fields($this->form, $this->form->fields());

        if ($this->table && method_exists($this->table, 'filters')) {
            foreach ($this->table->filters() as $details) {
                $details['name'] = 'filter.'.$details['name'];

                $sections['dictionary.filter'][] = $details;
            }
        }

        foreach ($sections as $section => $fields) {
            if (!array_key_exists('fields', $fields)) {
                $fields = [
                    'description' => null,
                    'fields'      => $fields,
                ];
            }

            $this->sections[$section]['description'] = $fields['description'];

            foreach ($fields['fields'] as $field) {
                $field                                = $this->validate_field($i++, $field);
                $field['hidden'] ??= false;
                $field['is_component']                = Str::startsWith($field['type'], 'component.');
                $field['is_livewire']                 = $field['type'] === 'autocomplete';
                $this->sections[$section]['fields'][] = $field;
            }
        }

        foreach ($this->form->actions() as $action) {
            $action          = $this->validate_action($i++, $action);
            $this->actions[] = $action;
        }
    }

    private function validate_action($index, $action): array
    {
        return match ($action['component']) {
            'field' => $this->validate_field(
                $index,
                [
                    'variant' => $action['variant'] ?? 'filled',
                    'hidden'  => $action['hidden'] ?? false,
                    'label'   => $action['label'],
                    'name'    => $action['name'],
                    'type'    => $action['type'],
                ]
            ),
            'link' => [
                'component' => $action['component'],
                'href'      => $action['route'],
                'label'     => $action['label'],
            ],
            default => throw new Exception(___('errors.exceptions.components.form.invalid-action', [$action['component']]))
        };
    }

    private function validate_attribute_type($field): string
    {
        return match ($field['type']) {
            // 'autocomplete', // This needs more work to implement, namely the value doesn't get set correctly
            'component.button',
            'component.link' => $field['type'],
            'date',
            'date-range',
            'editor',
            'email',
            'file',
            'number',
            'options',
            'password',
            'schedule',
            'search',
            'submit',
            'text',
            'textarea',
            'time'  => $field['type'],
            default => throw new Exception(___('errors.exceptions.components.form.invalid-input', [$field['type']]))
        };
    }

    private function validate_field($i, $field)
    {
        $field['placeholder'] ??= null;
        $multi_array            = false;
        $type                   = $this->validate_attribute_type($field);

        if ($type === 'options') {
            foreach ($field['options'] as $option) {
                if (is_array($option)) {
                    $multi_array = true;
                    break;
                }
            }

            if (count($field['options']) <= 5 && !$multi_array) {
                $type = $field['multiple'] ?? false ? 'checkbox' : 'radio';
            } else {
                $type = 'select';
            }
        }

        if ($field['placeholder'] === null) {
            $field['placeholder'] = in_array($type, ['date', 'select']) ? 'dictionary.select...' : $field['label'];
        }

        $processed_field = [
            'component' => match ($type) {
                'checkbox' => 'form.checkbox',
                'date',
                'date-range' => 'form.date',
                'editor'     => 'form.editor',
                'file'       => 'form.file',
                'radio'      => 'form.radio',
                'schedule'   => 'form.schedule',
                'select'     => 'form.select',
                'submit'     => 'button',
                'textarea'   => 'form.textarea',
                default      => 'form.input',
            },
            'type' => $type,
        ];

        if (str_starts_with($processed_field['type'], 'component.')) {
            foreach ($field as $attribute => $value) {
                $processed_field[$attribute] = $value;
            }
        } else {
            foreach ($field as $attribute => $value) {
                $attribute = Str::replace('-', '_', $attribute);

                if ($attribute === 'type') {
                    // We've already validated the type.
                    continue;
                }

                $processed_field[$attribute] = $value;
            }

            $processed_field['id'] = $field['name'].'-'.Conversions::to_base_64(ceil((microtime(true) - 1_731_605_637)));
        }

        return $processed_field;
    }
}
