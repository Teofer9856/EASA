<?php

namespace Database\Seeders;

use App\Models\Products;
use App\Models\Provinces;
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
        $classProvinces = new Provinces();
        $lista = $classProvinces->apiToArray();

        Products::factory(50)->create();
        Sellers::factory(10)->create();

        foreach($lista as $value){
            $province = new Provinces();
            $province->name = $value;
            $province->save();
        }
    }
}
