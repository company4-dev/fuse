<?php

declare(strict_types=1);

namespace App\Enums;

use App\Base\Enum;

enum SSOProvider
{
    use Enum;

    case Okta;

    public function class(): string
    {
        $base = 'App\\Providers\\SSO\\';

        return $base.match ($this) {
            self::Okta => 'OktaServiceProvider',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::Okta => 'dictionary.okta',
        };
    }
}
