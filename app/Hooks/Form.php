<?php

namespace Fuse\Hooks;

use Fuse\Enums\PlatformHook;
use Fuse\Traits\BaseHook;

class Form
{
    use BaseHook;

    const Fields     = 1;
    const Processing = 2;
    const SetModel   = 3;

    public static function get(mixed ...$args): array|bool
    {
        $is_fields     = false;
        $is_processing = false;
        $is_set_model  = false;
        $return        = [];
        $what          = $args[0] ?? null;

        self::validateAction($what);

        [$what, $data, $form] = array_pad($args, 3, null);

        if ($what === self::Fields) {
            $is_fields = true;
        } elseif ($what === self::Processing) {
            $is_processing = true;
        } elseif ($what === self::SetModel) {
            $is_set_model = true;
        }

        $form_class = is_string($form) ? $form : $form::class;

        foreach (self::getPlatformData(PlatformHook::Form, include_platform: false) as $class_map) {
            $sections = [];

            if (array_key_exists($form_class, $class_map)) {
                $component = $form->getComponent();

                if ($is_fields) {
                    $additional_fields = $class_map[$form_class]::fields($data, $form, $component);

                    if ($additional_fields) {
                        foreach ($additional_fields as $key => $field) {
                            if (is_numeric($key) && array_key_exists('name', $field)) {
                                $sections[class_basename($form_class)][] = $field;
                            } else {
                                $sections[$key] = $field;
                            }
                        }

                        // Prepend hooked. for Livewire compatibility
                        foreach ($sections as $section => $fields) {
                            foreach ($fields as $i => $field) {
                                $sections[$section][$i]['name'] = 'hooked.'.$field['name'];
                            }
                        }
                    }

                    $data = array_merge($data, $sections);
                } elseif ($is_processing) {
                    $class_map[$form_class]::process($data, $form, $component);
                } elseif ($is_set_model && method_exists($class_map[$form_class], 'setModel')) {
                    $return += $class_map[$form_class]::setModel($data, $component);
                }
            }
        }

        if ($is_fields) {
            return $data;
        }

        return $return;
    }
}
