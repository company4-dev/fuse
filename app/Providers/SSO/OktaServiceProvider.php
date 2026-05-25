<?php

declare(strict_types=1);

namespace App\Providers\SSO;

use App\Base\SSOServiceProvider;

class OktaServiceProvider extends SSOServiceProvider
{
    public static function fields(): array
    {
        return [];
    }
}
