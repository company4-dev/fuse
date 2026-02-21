<?php

namespace App\Traits;

use Exception;
use App\Helpers\Formatters;
use Illuminate\Support\Str;

trait BaseInputComponent
{
    public function validate_attributes(array $field, array $required = [], array $defaults = [])
    {
        $field = array_merge(
            [
                'description'  => null,
                'is_component' => false,
                'required'     => false,
                'value'        => null,
            ],
            $defaults,
            $field,
        );

        $required = array_unique(array_merge(
            [
                'name',
                'type',
            ],
            $required
        ));

        $skips = [  // These are either pre-validated or set by JellyBean
            'component',
            'id',
            'type',
        ];

        if (!$field['is_component']) {
            foreach ($required as $attribute) {
                if (!array_key_exists($attribute, $field)) {
                    throw new Exception(___('errors.exceptions.components.input.attribute-required', [$attribute, $field['label']]));
                }
            }

            if (in_array($field['type'], ['checkbox', 'radio', 'select']) && !array_key_exists('options', $field)) {
                throw new Exception(___('errors.exceptions.components.input.options-required', [$field['label']]));
            }

            foreach ($field as $attribute => $value) {
                if (in_array($attribute, $skips)) {
                    $this->$attribute = $value;
                } elseif (method_exists(self::class, 'validate_attribute_'.$attribute)) {
                    $this->$attribute = $this->{'validate_attribute_'.$attribute}($field, $value);
                } else {
                    throw new Exception(___('errors.exceptions.components.input.invalid-attribute', [$attribute, $field['label']]));
                }
            }
        }
    }

    private function validate_attribute_accepts($field, $value): array
    {
        if ($field['type'] !== 'file') {
            throw new Exception(___(
                'errors.exceptions.components.form.invalid-attribute-type',
                [
                    'accepts',
                    $field['label'],
                ]
            ));
        }

        return $value;
    }

    private function validate_attribute_autocomplete($field, $value): bool
    {
        // Log::critical('To validate: '.__FUNCTION__);

        return $value;
    }

    private function validate_attribute_autofocus($field, $value): bool
    {
        // Log::critical('To validate: '.__FUNCTION__);

        return $value;
    }

    public static function validate_attribute_callback($field, $value): string
    {
        return $value;
    }

    public static function validate_attribute_can_add($field, $value): bool
    {
        if ($field['type'] !== 'file') {
            throw new Exception(___(
                'errors.exceptions.components.form.invalid-attribute-type',
                [
                    'can-add',
                    $field['type'],
                    $field['label'],
                ]
            ));
        }

        return $value;
    }

    public static function validate_attribute_can_delete($field, $value): bool
    {
        if ($field['type'] !== 'file') {
            throw new Exception(___(
                'errors.exceptions.components.form.invalid-attribute-type',
                [
                    'can-delete',
                    $field['type'],
                    $field['label'],
                ]
            ));
        }

        return $value;
    }

    public static function validate_attribute_description($field, $value): ?string
    {
        return ___($value);
    }

    public static function validate_attribute_disabled($field, $value): bool
    {
        return $value;
    }

    public static function validate_attribute_files($field, $value): array
    {
        if ($field['type'] !== 'file') {
            throw new Exception(___(
                'errors.exceptions.components.form.invalid-attribute-type',
                [
                    'files',
                    $field['type'],
                    $field['label'],
                ]
            ));
        }

        return $value;
    }

    public static function validate_attribute_hidden($field, $value): bool
    {
        return $value;
    }

    public static function validate_attribute_is_component($field, $value): bool
    {
        return $value;
    }

    public static function validate_attribute_is_livewire($field, $value): bool
    {
        return $value;
    }

    public static function validate_attribute_label($field, $value): string
    {
        return ___($value);
    }

    private function validate_attribute_max($field, $value): int|null|string
    {
        if (!in_array($field['type'], ['date', 'datetime', 'number', 'range', 'time'])) {
            throw new Exception(___(
                'errors.exceptions.components.form.invalid-attribute-type',
                [
                    'max',
                    $field['type'],
                    $field['label'],
                ]
            ));
        }

        if (
            (
                (in_array($field['type'], ['number', 'range']) && !is_int($value))
                || (in_array($field['type'], ['date', 'datetime', 'time']) && !is_string($value))
            ) && $value !== null
        ) {
            throw new Exception(___('errors.exceptions.components.form.invalid-max', [$field['label']]));
        }

        return $value;
    }

    private function validate_attribute_min($field, $value): int|null|string
    {
        if (!in_array($field['type'], ['date', 'datetime', 'number', 'range', 'time'])) {
            throw new Exception(___(
                'errors.exceptions.components.form.invalid-attribute-type',
                [
                    'min',
                    $field['type'],
                    $field['label'],
                ]
            ));
        }

        if (
            (
                (in_array($field['type'], ['number', 'range']) && !is_int($value))
                || (in_array($field['type'], ['date', 'datetime', 'time']) && !is_string($value))
            ) && $value !== null
        ) {
            throw new Exception(___('errors.exceptions.components.form.invalid-min', [$field['label']]));
        }

        return $value;
    }

    public static function validate_attribute_modifier($field, $value): string
    {
        if (in_array($field['type'], ['date', 'date-range'])) {
            $valid_modifiers = [
                'change',
                'live',
                null,
            ];
        } elseif (in_array($field['type'], ['checkbox', 'radio', 'select'])) {
            $valid_modifiers = [
                'change',
                null,
            ];
        } else {
            $valid_modifiers = [
                null,
                'blur',
                'live',
            ];
        }

        return in_array($value, $valid_modifiers)
            ? $value
            : throw new Exception(___(
                'errors.exceptions.components.form.invalid-modifier',
                [
                    Formatters::implode(
                        '`, `',
                        '` '.___('dictionary.or').' `',
                        array_map(fn ($item) => $item ?? 'null', $valid_modifiers)
                    ),
                    $field['label'],
                ]
            ));
    }

    private function validate_attribute_multiple($field, $value): bool
    {
        if (!is_bool($value)) {
            throw new Exception(___('errors.exceptions.components.form.invalid-multiple', [$field['label']]));
        }

        return $value;
    }

    private function validate_attribute_name($field, $value): string
    {
        return Str::start($value, 'form.');
    }

    private function validate_attribute_options($field, $value): ?array
    {
        if (!in_array($field['type'], ['checkbox', 'radio', 'select'])) {
            return null;
        }

        if (!is_array($value)) {
            throw new Exception(___('errors.exceptions.components.form.invalid-options'));
        }

        return $value;
    }

    public static function validate_attribute_placeholder($field, $value): string
    {
        return ___($value);
    }

    private function validate_attribute_prefix($field, $value): string
    {
        return $value;
    }

    private function validate_attribute_required($field, $value): bool
    {
        if (!is_bool($value)) {
            throw new Exception(___('errors.exceptions.components.input.invalid-required', [$field['label']]));
        }

        return $value;
    }

    private function validate_attribute_rules($field, $value): array
    {
        if (!is_array($value)) {
            throw new Exception(___('errors.exceptions.components.form.invalid-rules'));
        }

        return $value;
    }

    private function validate_attribute_step($field, $value): float|string
    {
        if (!in_array($field['type'], ['date', 'datetime', 'number', 'range', 'time'])) {
            throw new Exception(___(
                'errors.exceptions.components.form.invalid-attribute-type',
                [
                    'step',
                    $field['type'],
                    $field['label'],
                ]
            ));
        }

        if (!is_numeric($value) && $value !== 'any') {
            throw new Exception(___('errors.exceptions.components.form.invalid-step', [$field['label']]));
        }

        return $value;
    }

    private function validate_attribute_suffix($field, $value): string
    {
        return $value;
    }

    private function validate_attribute_value($field, $value): mixed
    {
        // Log::critical('To validate: '.__FUNCTION__);

        return $value;
    }

    private function validate_attribute_variant($field, $value): string
    {
        return in_array(
            $value,
            [
                'danger',
                'default',
                'filled',
                'ghost',
                'primary',
                'subtle',
            ]
        )
            ? $value
            : throw new Exception(___('errors.exceptions.components.form.invalid-variant'));
    }

    private function validate_attribute_wire($field, array $value): array
    {
        $return         = [];
        $supported_keys = [
            'loading',
        ];

        foreach ($value as $key => $val) {
            $test = $key;
            if (str_contains($test, '.')) {
                $test = explode('.', $test)[0];
            }

            if (!in_array($test, $supported_keys)) {
                throw new Exception(___('errors.exceptions.components.form.invalid-wire-attribute', [$test, $field['label']]));
            }

            $return[$key] = $val;
        }

        return $return;
    }

    private function validate_attribute_x_on_change($field, $value): ?string
    {
        return $value;
    }
}
