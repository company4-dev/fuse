<?php

declare(strict_types=1);

namespace App\View\Components;

use App\Helpers\Conversions;
use App\Helpers\Formatters;
use App\Hooks\Form as FormHook;
use Closure;
use Exception;
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

    /**
     * @var 'default'|'inline'|'ungrouped'
     */
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
        $this->type  = in_array($type, $accepted_types, true)
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
        $sections = FormHook::get(FormHook::FIELDS, $sections, $form, $form->getComponent());

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
        $sections = static::normalise_fields($this->form, $this->form->fields());

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

    private function validate_action(int $index, array $action): array
    {
        if (array_key_exists('type', $action)) {
            return $this->validate_field(
                $index,
                [
                    'variant' => $action['variant'] ?? 'filled',
                    'hidden'  => $action['hidden'] ?? false,
                    'label'   => $action['label'],
                    'name'    => $action['name'],
                    'type'    => $action['type'],
                ]
            );
        }

        if (array_key_exists('route', $action)) {
            return [
                'component' => 'link',
                'href'      => $action['route'],
                'label'     => $action['label'],
            ];
        }

        throw new Exception(___('errors.exceptions.components.form.invalid-action', $action['component']));
    }

    private function validate_attribute_type(array $field): string
    {
        return match ($field['type']) {
            'autocomplete', // This needs more work to implement, namely the value doesn't get set correctly
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
            'switch',
            'text',
            'textarea',
            'time'  => $field['type'],
            default => throw new Exception(___('errors.exceptions.components.form.invalid-input', $field['type']))
        };
    }

    /**
     * @return mixed[]
     */
    private function validate_field(int $i, array $field): array
    {
        $class_vars             = get_class_vars($this->form::class);
        $field['placeholder'] ??= null;
        $multi_array            = false;
        $throw                  = false;
        $type                   = $this->validate_attribute_type($field);

        if ($field['type'] !== 'submit'
            && !str_starts_with($field['type'], 'component.')
            && !array_key_exists($field['name'], $class_vars)
        ) {
            // Check if the base property exists
            if (str_contains($field['name'], '.')) {
                [$property] = explode('.', $field['name']);

                $throw = !array_key_exists($property, $class_vars);
            } else {
                // String doesn't contain a dot so wasn't found
                $throw = true;
            }

            if ($throw) {
                throw new Exception(___(
                    'errors.exceptions.components.form.missing-property',
                    [
                        $field['name'],
                        $this->form::class,
                    ]
                ));
            }
        }

        if ($type === 'options') {
            foreach ($field['options'] as $option) {
                if (is_array($option) && !array_key_exists('label', $option)) {
                    $multi_array = true;

                    break;
                }
            }

            if (count($field['options']) <= 5 && !$multi_array && $this->type !== 'inline') {
                $type = $field['multiple'] ?? false ? 'checkbox' : 'radio';
            } else {
                $type = 'select';
            }
        }

        if ($field['placeholder'] === null) {
            $field['placeholder'] = in_array($type, ['date', 'select'], true)
                ? 'dictionary.select...'
                : $field['label'];
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
                'submit'     => 'form.button',
                'switch'     => 'form.toggle',
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

            $processed_field['id'] = $field['name'].'-'
                .Conversions::to_base_64((int) microtime(true) - 1_731_605_637);
        }

        return $processed_field;
    }
}
