<?php

namespace App\Enums;

use App\Traits\BaseEnum;

enum TenantDisplay
{
    use BaseEnum;

    case Both;
    case Central;
    case Tenant;
}
