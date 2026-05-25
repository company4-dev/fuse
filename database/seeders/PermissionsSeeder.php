<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Hooks\Permissions as HooksPermissions;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = HooksPermissions::get(HooksPermissions::POPULATE, true);

        foreach ($permissions as $platform_name => $platform_permissions) {
            foreach ($platform_permissions as $permission) {
                Permission::firstOrCreate([
                    'name'     => $permission->name,
                    'platform' => $platform_name === 'jellybean' ? null : $platform_name,
                ]);
            }
        }
    }
}
