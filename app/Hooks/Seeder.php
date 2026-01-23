<?php

namespace Fuse\Hooks;

use Fuse\Enums\PlatformHook;
use Fuse\Traits\BaseHook;
use Database\Seeders\PermissionsSeeder;
use Database\Seeders\RolesSeeder as CoreRolesSeeder;
use Database\Seeders\Tenants\RolesSeeder as TenantRolesSeeder;
use Database\Seeders\Tenants\UsersSeeder as TenantUsersSeeder;
use Database\Seeders\UsersSeeder as CoreUsersSeeder;
use InvalidArgumentException;

class Seeder
{
    use BaseHook;

    const Core   = 1;
    const Tenant = 2;

    public static function get(mixed ...$args): array
    {
        $seeders = [
            self::Core => [
                PermissionsSeeder::class,
                CoreRolesSeeder::class,
                CoreUsersSeeder::class,
            ],
            self::Tenant => [
                PermissionsSeeder::class,
                TenantRolesSeeder::class,
                TenantUsersSeeder::class,
            ],
        ];

        $type = $args[0] ?? null;

        self::validateAction($type);

        $seeders = $seeders[$type];

        foreach (self::getPlatformData(PlatformHook::Seeder, $type, false) as $slug => $classes) {
            if ($classes) {
                if (!array_key_exists($type, $classes)) {
                    throw new InvalidArgumentException(___('errors.exceptions.hooks.seeder.invalid-data', $slug));
                }

                $seeders = array_merge($seeders, $classes);
            }
        }

        return $seeders;
    }
}
