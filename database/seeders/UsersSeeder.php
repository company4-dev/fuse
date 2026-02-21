<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
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
        $users = User::select('id')->whereIn('id', [1, 2])->get();

        if (!$users->where('id', 1)->count()) {
            User::create([
                'id'         => 1,
                'first_name' => 'Sheldon',
                'last_name'  => 'Mascot',
                'email'      => 'no-reply@jellyhaus.com',
                'password'   => bcrypt(Str::uuid()),
                'role_id'    => 1,
            ]);
        }

        if (!$users->where('id', 2)->count()) {
            User::create([
                'created_by' => 1,
                'first_name' => 'Jellyhaus',
                'last_name'  => 'Developer',
                'email'      => 'support@jellyhaus.com',
                'password'   => bcrypt('JayTheChicken'),
                'role_id'    => 2,
                'updated_by' => 1,
            ]);
        }
    }
}
