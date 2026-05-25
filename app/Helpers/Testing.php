<?php

declare(strict_types=1);

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Pest\Arch\Exceptions\ArchExpectationFailedException;
use Pest\Arch\ValueObjects\Violation;

class Testing
{
    public static function find_usage(string $find, string $glob_pattern, string $message): void
    {
        $base_path  = Storage::disk('root')->path('');
        $files      = glob($base_path.$glob_pattern, GLOB_BRACE);

        foreach ($files as $file) {
            $lines = file($file, FILE_IGNORE_NEW_LINES);

            foreach ($lines as $line_number => $line) {
                if (str_contains($line, $find)) {
                    throw new ArchExpectationFailedException(
                        new Violation($file, $line_number + 1, $line_number + 1),
                        $message
                    );
                }
            }
        }
    }

    public static function wildcard_to_array(string $pattern, array $exclude = [])
    {
        once(fn (): mixed => dump('To deprecate when fixed in Pest: https://github.com/pestphp/pest/issues/1383'));

        return collect(require __DIR__.'/../../vendor/composer/autoload_classmap.php')
            ->filter(static fn ($path, $class): bool => Str::is($pattern, $class)
                && !collect($exclude)->contains(static fn ($ex) => Str::contains($class, '\\'.$ex.'\\')))
            ->keys()
            ->toArray();
    }
}
