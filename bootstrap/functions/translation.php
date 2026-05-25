<?php

declare(strict_types=1);

function ___(mixed $translation_string, array|float|string $replacements = [])
{
    if (is_array($translation_string)) {
        [$translation_string, $replacements] = $translation_string[1] ? $translation_string : $translation_string + [];
    }

    if (!is_array($replacements)) {
        $replacements = array_filter([$replacements]);
    }

    if (!is_array($replacements)) {
        $replacements = [$replacements];
    }

    foreach ($replacements as &$replacement) {
        if (!is_array(___($replacement))) {
            $replacement = ___($replacement);
        }
    }

    unset($replacement);

    $translation = __($translation_string, $replacements);

    if (is_array($translation)) {
        return $translation_string;
    }

    return __($translation_string, $replacements);
}
