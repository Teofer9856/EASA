<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\ClientProduct;
use App\Models\Product;
use App\Models\Province;
use App\Models\Seller;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $classProvinces = new Province();
        $lista = $classProvinces->apiToArray();

        Product::factory(50)->create();
        Seller::factory(10)->create();

        foreach($lista as $value){
            Province::create([
                'name' => $value
            ]);
        }
        Client::factory(40)->create();
        ClientProduct::factory(20)->create();
        $this->call(UserSeeder::class);
    }
}
