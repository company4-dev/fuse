<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Hooks\Seeder as HooksSeeder;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(HooksSeeder::get(HooksSeeder::CORE));
    }
}
