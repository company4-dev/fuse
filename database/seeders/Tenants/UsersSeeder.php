<?php

namespace Database\Seeders\Tenants;

use Fuse\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!User::find(1)) {
            User::create([
                'created_by' => 1,
                'first_name' => 'Sheldon',
                'last_name'  => 'Automation',
                'email'      => 'no-reply@jellyhaus.com',
                'password'   => Hash::make(Str::uuid()),
                'updated_by' => 1,
            ]);

            User::create([
                'created_by' => 1,
                'first_name' => 'Jellyhaus',
                'last_name'  => 'Developer',
                'email'      => 'support@jellyhaus.com',
                'password'   => Hash::make('JayTheChicken'),
                'updated_by' => 1,
            ]);
        }
    }
}
