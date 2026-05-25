<?php

declare(strict_types=1);

namespace App\Enums;

use App\Base\Enum;

enum SSOStatus: int
{
    use Enum;

    case Off      = 0;
    case Optional = 1;
    case Forced   = 2;

    public function description(): string
    {
        return match ($this) {
            self::Off      => 'settings.sso.status.off',
            self::Optional => 'settings.sso.status.optional',
            self::Forced   => 'settings.sso.status.forced',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::Off      => 'dictionary.off',
            self::Optional => 'dictionary.optional',
            self::Forced   => 'dictionary.forced',
        };
    }
}
