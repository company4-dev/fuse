<?php

namespace App\Enums;

use App\Traits\BaseEnum;
use App\Traits\BasePermissionsEnum;

enum Permissions
{
    use BaseEnum;
    use BasePermissionsEnum;

    // Dashboard
    case Dashboard;

    // Logs
    case Logs;

    // Users
    case Impersonation;
    case Profile;
    case Roles;

    public function display(): TenantDisplay
    {
        return TenantDisplay::Both;
    }

    public function label(): string
    {
        return match ($this) {
            Permissions::Dashboard     => 'permissions.dashboard',
            Permissions::Impersonation => 'permissions.impersonation',
            Permissions::Logs          => 'permissions.logs',
            Permissions::Profile       => 'permissions.profile',
            Permissions::Roles         => 'permissions.roles',
            default                    => false,
        };
    }

    public function fixed(): bool
    {
        return match ($this) {
            Permissions::Dashboard => true,
            Permissions::Profile   => true,
            default                => false,
        };
    }

    public function group(): string
    {
        return 'dictionary.jellybean';
    }
}
