<?php

declare(strict_types=1);

namespace App\Base;

// Enums can't extend classes, so this must be a trait
trait Enum
{
    /**
     * @return mixed[]
     */
    public static function array_column($column, $key = null): array
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

    public static function fromName($name): ?self
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

        return null;
    }

    public static function fromValue($value): ?self
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

        return null;
    }

    public static function map(callable $callback, bool $flip = false): array
    {
        $cases  = self::cases();
        $return = [];

        if ($flip) {
            $cases = array_flip($cases);
        }

        foreach ($cases as $case) {
            $return[$case->value ?? $case->name] = $callback($case);
        }

        return $return;
    }

    public static function toArray($flip = false): array
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
            return array_flip($cases);
        }

        return $cases;
    }

    public function value()
    {
        return property_exists($this, 'value') ? ___($this->value) : null;
    }
}
