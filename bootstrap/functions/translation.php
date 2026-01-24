<?php

use App\Helpers\Log;
use Illuminate\Support\Str;

function ___($translation_string, array $replacements = [])
{
    if (is_array($translation_string)) {
        [$translation_string, $replacements] = $translation_string[1] ? $translation_string : $translation_string + [];
    } elseif (is_string($translation_string) && Str::substrCount($translation_string, ':') === 1) {
        [$translation_string, $replacements] = explode(':', $translation_string);

        $replacements = explode(',', $replacements);
    } elseif (is_string($translation_string) && Str::substrCount($translation_string, ':') === 3) {
        Log::critical('Platform translation not yet supported');
    }

    if ($replacements) {
        foreach ($replacements as &$replacement) {
            if (!is_array(___($replacement))) {
                $replacement = ___($replacement);
            }
        }
    }

    unset($replacement);

    $translation = __($translation_string, $replacements);

    if (is_array($translation)) {
        return $translation_string;
    }

    return __($translation_string, $replacements);
}
