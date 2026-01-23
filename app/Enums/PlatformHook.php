<?php

namespace Fuse\Enums;

use Fuse\Traits\BaseEnum;

enum PlatformHook
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
