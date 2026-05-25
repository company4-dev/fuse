<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $emails = ['no-reply@jellyhaus.com', 'support@jellyhaus.com'];
        $users  = User::select('id', 'email')->whereIn('email', $emails)->get();

        if (!$users->where('email', $emails[0])->count()) {
            User::create([
                'id'         => 1,
                'first_name' => 'Sheldon',
                'last_name'  => 'Mascot',
                'email'      => $emails[0],
                'password'   => bcrypt(Str::uuid()),
                'role_id'    => 1,
            ]);
        }

        if (!$users->where('email', $emails[1])->count()) {
            User::create([
                'created_by' => 1,
                'first_name' => 'Jellyhaus',
                'last_name'  => 'Developer',
                'email'      => $emails[1],
                'password'   => bcrypt('JayTheChicken'),
                'role_id'    => 2,
                'updated_by' => 1,
            ]);
        }
    }
}
