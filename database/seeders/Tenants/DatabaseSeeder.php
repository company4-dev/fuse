<?php

declare(strict_types=1);

namespace Database\Seeders\Tenants;

use App\Hooks\Seeder as HooksSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get Tenant Seeders from Platforms (Including the Tenants platform)
        $this->call(HooksSeeder::get(HooksSeeder::TENANT));
    }
}
