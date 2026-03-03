<?php

namespace App\Enums;

use App\Traits\BaseEnum;

enum FuseHook
{
    use BaseEnum;

    case AuthMessages;
    case Form;
    case Icons;
    case Management;
    case Menu;
    case Permissions;
    case Seeder;
}
