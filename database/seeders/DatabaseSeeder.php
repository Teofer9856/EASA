<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Seller;
use App\Models\Product;
use App\Models\Province;
use App\Models\ClientProduct;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(ProductSeeder::class);
        $this->call(SellerSeeder::class);
        $this->call(ProvinceSeeder::class);
        $this->call(ClientSeeder::class);
        $this->call(ClientProductSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
    }
}
