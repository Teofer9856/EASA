<?php

namespace Database\Seeders;

use App\Models\ClientProduct;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ClientProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ClientProduct::factory(20)->create();
    }
}
