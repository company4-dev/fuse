<?php

declare(strict_types=1);

namespace App\Enums;

use App\Base\Enum;

enum TenantDisplay
{
    use Enum;

    case Both;
    case Central;
    case Tenant;
}
