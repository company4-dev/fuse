<?php

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
        // Core
        $this->call(HooksSeeder::get(HooksSeeder::Tenant));    // Get Tenant Seeders from Platforms (Including the Tenants platform)
    }
}
