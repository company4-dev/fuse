<?php

namespace App\Traits;

trait BaseEnum
{
    public static function array_column($column, $key = null)
    {
        $return = [];

        foreach (self::cases() as $case) {
            if ($key) {
                $return[$case->value[$key]] = $case->value[$column];
            } else {
                $return[$case->name] = $case->value[$column];
            }
        }

        return $return;
    }

    public static function fromName($name)
    {
        // Try a direct match
        foreach (self::cases() as $case) {
            if ($case->name === $name) {
                return $case;
            }
        }

        // Try a case-insensitive match
        foreach (self::cases() as $case) {
            if (strtolower($case->name) === strtolower($name)) {
                return $case;
            }
        }
    }

    public static function fromValue($value)
    {
        // Try a direct match
        foreach (self::cases() as $case) {
            if ($case->value === $value) {
                return $case;
            }
        }

        // Try a case-insensitive match
        foreach (self::cases() as $case) {
            if (strtolower($case->value) === strtolower($value)) {
                return $case;
            }
        }
    }

    public static function map(callable $callback, bool $flip = false): array
    {
        $cases  = self::cases();
        $return = [];

        if ($flip) {
            $cases = array_flip($cases);
        }

        foreach ($cases as $case) {
            $return[$case->value] = $callback($case);
        }

        return $return;
    }

    public static function toArray($flip = false)
    {
        $cases = self::cases();

        if (isset($cases[0]->value)) {
            $cases = array_map(
                ___(...),
                array_column(self::cases(), 'value', 'name')
            );
        } else {
            $cases = array_column(self::cases(), 'name');
        }

        if ($flip) {
            $cases = array_flip($cases);
        }

        return $cases;
    }

    public function value()
    {
        return property_exists($this, 'value') ? ___($this->value) : null;
    }
}
