<?php

declare(strict_types=1);

namespace App\Hooks;

use App\Base\Hook;
use App\Enums\PlatformHook;
use Database\Seeders\PermissionsSeeder;
use Database\Seeders\RolesSeeder as CoreRolesSeeder;
use Database\Seeders\Tenants\RolesSeeder as TenantRolesSeeder;
use Database\Seeders\Tenants\UsersSeeder as TenantUsersSeeder;
use Database\Seeders\UsersSeeder as CoreUsersSeeder;
use InvalidArgumentException;

class Seeder extends Hook
{
    const CORE   = 1;
    const TENANT = 2;

    public static function get(mixed ...$args): array
    {
        $seeders = [
            self::CORE => [
                PermissionsSeeder::class,
                CoreRolesSeeder::class,
                CoreUsersSeeder::class,
            ],
            self::TENANT => [
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
