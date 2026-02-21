<?php

namespace Database\Seeders\Tenants;

use App\Enums\Permissions;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    public function run(): void
    {
        $existing_roles = Role::locked()->get();
        $permissions    = Permission::select('id', 'name')->wherePlatform()->get();
        $roles          = [
            'Automation' => [
                'color'       => 'yellow',
                'permissions' => [],
            ],
            'Administrator' => [
                'color'       => 'orange',
                'permissions' => [
                    Permissions::Dashboard,
                    Permissions::Impersonation,
                    Permissions::Logs,
                    Permissions::Profile,
                    Permissions::Roles,
                ],
            ],
            'Staff' => [
                'color'       => 'lime',
                'permissions' => [
                    Permissions::Dashboard,
                    Permissions::Profile,
                ],
            ],
            'User' => [
                'color'       => 'cyan',
                'permissions' => [
                    Permissions::Dashboard,
                    Permissions::Profile,
                ],
            ],
        ];

        foreach ($roles as $name => $details) {
            $role = $existing_roles->where('name', $name)->first();

            if (!$role) {
                $role = new Role;

                $role->color       = $details['color'];
                $role->description = null;
                $role->guard_name  = 'web';
                $role->locked      = true;
                $role->name        = $name;

                $role->saveQuietly();
            }

            if ($details['permissions']) {
                $role
                    ->permissions()
                    ->sync($permissions
                        ->whereIn(
                            'name',
                            array_map(
                                fn ($permission) => $permission->name,
                                $details['permissions']
                            )
                        )
                        ->pluck('id'));
            }
        }
    }
}
