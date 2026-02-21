<?php

namespace App\Helpers;

class Conversions
{
    /**
     * Replace placeholders.
     *
     * @param  string $string The string with placeholders in
     * @param  array  $data   The placeholder data
     * @param  string $open   The opening tags to search for
     * @param  string $close  The closing tags to search for
     * @return string
     */
    public static function replace_placeholders(string $string, array $data, string $open = '{{', string $close = '}}')
    {
        foreach ($data as $key => $value) {
            if (!in_array(gettype($value), ['array', 'object'])) {
                $string = preg_replace('/'.$open.$key.$close.'/i', $value, $string);
            }
        }

        return $string;
    }

    public static function ini_size_to_bytes(string $value): int
    {
        $number = (int) $value;
        $unit   = strtoupper(substr($value, -1));

        return match ($unit) {
            'K'     => $number * 1024,
            'M'     => $number * 1024 ** 2,
            'G'     => $number * 1024 ** 3,
            default => $number,
        };
    }

    public static function to_base_64(int $number): string
    {
        $base = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ-_';
        $b    = strlen($base);
        $r    = $number % $b;
        $res  = $base[$r];
        $q    = floor($number / $b);

        while ($q) {
            $r   = $q % $b;
            $q   = floor($q / $b);
            $res = $base[$r].$res;
        }

        return $res;
    }
}
