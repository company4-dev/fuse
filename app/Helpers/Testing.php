<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class Testing
{
    public static function wildcard_to_array(string $pattern, array $exclude = [])
    {
        // dump('To deprecate when fixed in Pest: https://github.com/pestphp/pest/issues/1383');

        return collect(require __DIR__.'/../../vendor/composer/autoload_classmap.php')
            ->filter(
                fn ($path, $class) => Str::is($pattern, $class)
                    && !collect($exclude)->contains(fn ($ex) => Str::contains($class, '\\'.$ex.'\\'))
            )
            ->keys()
            ->toArray();
    }
}
