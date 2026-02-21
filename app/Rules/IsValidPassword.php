<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use ZxcvbnPhp\Zxcvbn;

class IsValidPassword implements ValidationRule
{
    public static function is_valid(mixed $password1, mixed $password2 = null): array|bool
    {
        $length   = max(8, config('settings.security.minimum-password-length'));
        $messages = [];
        $strength = null;

        if (strlen($password1) < $length) {
            $messages[] = 'The password must be at least '.$length.' characters';
        }

        if ($password2 !== null && $password1 !== $password2) {
            $messages[] = 'The password confirmation does not match';
        }

        $strength = (new Zxcvbn)->passwordStrength($password1);

        if ($strength['score'] < config('settings.security.minimum-password-strength')) {
            if ($strength['feedback']['warning']) {
                $messages[] = 'The password does not match the required password strength. '.$strength['feedback']['warning'].'.';
            } else {
                $messages[] = 'The password does not match the required password strength.';
            }
        }

        return $messages ?: true;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $is_valid = self::is_valid($value);

        if ($is_valid !== true) {
            $fail(___('validation.password.valid', [$attribute, implode('</li><li>', $is_valid)]));
        }
    }
}
