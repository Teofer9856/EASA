<?php

namespace Database\Seeders;

use App\Models\Products;
use App\Models\Sellers;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Products::factory(50)->create();
        Sellers::factory(10)->create();
    }
}
