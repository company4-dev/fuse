<?php

namespace Database\Seeders;

use Fuse\Hooks\Seeder as HooksSeeder;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(HooksSeeder::get(HooksSeeder::Core));
    }
}
