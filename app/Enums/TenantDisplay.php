<?php

namespace Fuse\Enums;

use Fuse\Traits\BaseEnum;

enum TenantDisplay
{
    use BaseEnum;

    case Both;
    case Central;
    case Tenant;
}
