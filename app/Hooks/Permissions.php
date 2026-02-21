<?php

namespace App\Hooks;

use App\Enums\Permissions as CorePermissions;
use App\Enums\PlatformHook;
use App\Enums\TenantDisplay;
use App\Helpers\Tenants;
use App\Traits\BaseHook;

class Permissions
{
    use BaseHook;

    const Populate = 1;
    const Select   = 2;

    public static function get(mixed ...$args)
    {
        $include_all = $args[1] ?? false;
        $is_tenant   = Tenants::is_tenant();
        $return      = ['jellybean' => CorePermissions::cases()];
        $type        = $args[0];

        self::validateAction($type, true);

        foreach (self::getPlatformData(PlatformHook::Permissions) as $hook_data) {
            $platform_name = $hook_data['platform']->getName();

            foreach ($hook_data['data'] as $permission) {
                if ($include_all) {
                    $return[$platform_name][] = $permission;
                } elseif (($is_tenant && in_array($permission->display(), [TenantDisplay::Both, TenantDisplay::Tenant]))
                    || (!$is_tenant && in_array($permission->display(), [TenantDisplay::Both, TenantDisplay::Central]))
                ) {
                    $return[$platform_name][] = $permission;
                }
            }
        }

        // Additional Processing if needed
        if ($return && $type === self::Select) {
            $temp = [];

            foreach ($return as $permissions) {
                foreach ($permissions as $permission) {
                    $group = $permission->group();

                    $temp[$group][$permission->name] = [
                        'checked'     => $permission->fixed(),
                        'description' => $permission->label().'.description',
                        'disabled'    => $permission->fixed(),
                        'label'       => $permission->label().'.label',
                    ];
                }
            }

            $return = $temp;
        }

        return $return;
    }
}
