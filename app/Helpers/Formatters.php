<?php

namespace App\Helpers;

use Illuminate\Support\Number;

class Formatters
{
    public static function implode(string $glue, string $last_glue, array $pieces)
    {
        $last = array_pop($pieces);

        return implode($glue, $pieces).$last_glue.$last;
    }

    public static function money(int|float $number)
    {
        return Number::currency($number);
    }
}
