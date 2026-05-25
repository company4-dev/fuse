<?php

declare(strict_types=1);

namespace App\Enums;

use App\Base\Enum;

enum PlatformHook
{
    use Enum;

    case AuthMessages;
    case Dashboard;
    case Form;
    case Icons;
    case Management;
    case Menu;
    case Permissions;
    case Search;
    case Seeder;
}
