<?php

declare(strict_types=1);

namespace App\Base;

use App\Helpers\Conversions;
use App\Helpers\Log;
use App\Helpers\Schedule;
use App\Hooks\Form as FormHook;
use App\Hooks\Form as HooksForm;
use App\Rules\IsValidEmail;
use App\Rules\IsValidPassword;
use App\View\Components\Form;
use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\Form as BaseForm;

abstract class LivewireForm extends BaseForm
{
    public $errors;

    // Compatibility for hooked form fields
    public array $hooked;

    final public function model(Model $model): void
    {
        $component    = $this->getComponent();
        $this->hooked = HooksForm::get(FormHook::SET_MODEL, $model, $this, $component);

        $this->setModel($model, $component);
    }

    final public function process(
        Closure|Component $component,
        callable $success,
        ?callable $after_validation = null,
        ?callable $error = null
    ) {
        $data            = [];
        $sections        = Form::normalise_fields($this, $this->fields());
        $validation_keys = null;
        $validations     = [];

        foreach ($this->all() as $key => $value) {
            $data[$key] = $value;
        }

        foreach ($sections as $section_data) {
            $schedule_position = array_search('schedule', array_column($section_data['fields'], 'type'), true);

            if ($schedule_position !== false) {
                // Merge in fixed schedule fields for validation
                $section_data['fields'] = array_merge(
                    $section_data['fields'],
                    Schedule::fields($section_data['fields'][$schedule_position]),
                );
            }

            foreach ($section_data['fields'] as $field) {
                if ($field['type'] === 'schedule') {
                    // We've processed the schedule above, we don't need this now.
                    continue;
                }

                if (str_starts_with($field['type'], 'component.')) {
                    // We don't need to validate components
                    continue;
                }

                $is_multiple = false;
                $name        = str_replace('form.', '', $field['name']);

                // Add initial form-defined rules
                $rules = $field['rules'] ?? [];

                // Add additional rules based on field data
                $rules[] = $field['required'] ?? false ? 'required' : 'nullable';

                if ($field['type'] === 'options') {
                    $rules[] = Rule::in($this->getOptions($field['options']));

                    // For single checkboxes (options with 1 item, not required, not multiple)
                    if (count($field['options']) <= 5
                        && !($field['multiple'] ?? false)
                        && !($field['required'] ?? false)
                    ) {
                        unset($rules[count($rules) - 1]);
                    }

                    $is_multiple = $field['multiple'] ?? false;
                } elseif ($field['type'] === 'date') {
                    $rules[] = 'date_format:Y-m-d';
                } elseif ($field['type'] === 'email') {
                    $rules[] = 'email';
                    $rules[] = new IsValidEmail;
                    $rules[] = 'lowercase';
                } elseif ($field['type'] === 'file') {
                    $is_multiple = $field['multiple'] ?? false;
                    $rules[]     = 'extensions:'.implode(',', $field['accepts']->extensions());
                    $rules[]     = 'file';
                    $rules[]     = 'max:'.Conversions::ini_size_to_bytes(ini_get('upload_max_filesize')) / 1024;
                    $rules[]     = 'mimetypes:'.implode(',', $field['accepts']->mimes());
                } elseif ($field['type'] === 'number') {
                    $rules[] = 'numeric';

                    if ($field['max'] ?? false) {
                        $rules[] = 'max:'.$field['max'];
                    }

                    if ($field['min'] ?? false) {
                        $rules[] = 'min:'.$field['min'];
                    }
                } elseif (in_array($field['type'], ['editor', 'text'], true)) {
                    $rules[] = 'max:255';
                    $rules[] = 'string';
                } elseif ($field['type'] === 'password') {
                    $rules[] = 'string';
                } elseif ($field['type'] === 'search') {
                    $rules[] = 'string';
                } elseif ($field['type'] === 'switch') {
                    $rules[] = 'boolean';
                } elseif ($field['type'] === 'textarea') {
                    $rules[] = 'string';
                } elseif ($field['type'] === 'time') {
                    // Accepts H:i (manual) or H:i:s (re-population)
                    $rules[] = 'regex:/^(?:[01]\d|2[0-3]):[0-5]\d(?::[0-5]\d)?$/';
                } else {
                    Log::emergency('Type validation not yet supported for '.$field['type']);
                }

                if ($field['type'] === 'password') {
                    if (!in_array('allow-insecure', $rules, true) && !str_ends_with($name, '_confirmation')) {
                        $rules[] = new IsValidPassword;
                    }

                    unset($rules[array_search('allow-insecure', $rules, true)]);
                }

                if ($is_multiple) {
                    if (in_array('nullable', $rules, true)) {
                        /**
                         * Make sure if the field is nullable, we also allow nullable in the "parent" field.
                         *
                         * E.g.:
                         * 'checks' => [    // Parent
                         *     0 => 1,      // Child 1
                         *     1 => 2,      // Child 2
                         * ]
                         *
                         * Generates:
                         * 'checks'   => 'nullable',
                         * 'checks.*' => 'nullable',
                         */
                        $validations[$name] = 'nullable';
                    }

                    $name .= '.*';
                }

                $validations[$name] = $rules;
            }
        }

        $validation_keys = array_filter(
            array_keys($validations),
            static fn (string $key): bool => str_ends_with($key, '_confirmation')
        );

        foreach ($validation_keys as $key) {
            $key = str_replace('_confirmation', '', $key);

            if (!in_array('confirmed', $validations[$key], true)) {
                $validations[$key][] = 'confirmed';
            }
        }

        $validator = Validator::make($data, $validations);

        if (is_callable($after_validation)) {
            $validator->after($after_validation);
        }

        if ($validator->fails()) {
            $component->dispatch('scroll-to-top');

            if (is_callable($error)) {
                $error($validator, $data);
            }

            throw new ValidationException($validator);
        }

        $validated = collect($validator->validated());

        // Revert hooked. for hook processing
        if ($validated['hooked'] ?? false) {
            foreach ($validated['hooked'] as $key => $value) {
                $validated[$key] = $value;
            }

            unset($validated['hooked']);
        }

        // Process original form
        $success = $success($validated);

        // Process hooked fields
        HooksForm::get(HooksForm::PROCESSING, $validated, $component->form);

        return $success;
    }

    public function removeFile($name, $index = null): void
    {
        $name = str_replace('form.', '', $name);

        if ($index === null) {
            $this->$name->delete();
            $this->$name = null;
        } else {
            $files = $this->$name;

            $files[$index]->delete();

            unset($files[$index]);

            $this->$name = array_values($files);
        }
    }

    private function getOptions(array|Collection $options): array
    {
        $return = [];

        foreach ($options as $key => $option) {
            if (is_array($option) && !array_key_exists('label', $option)) {
                $return = array_merge($return, $this->getOptions($option));
            } else {
                $return[] = $key;
            }
        }

        return $return;
    }

    abstract public function actions(): array;

    abstract public function fields(): array;

    abstract protected function setModel($model, object $component): void;
}
