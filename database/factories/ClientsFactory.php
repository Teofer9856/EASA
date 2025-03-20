<?php

namespace Database\Factories;

use App\Models\Provinces;
use App\Models\Sellers;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Clients>
 */
class ClientsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $size_provinces = count(Provinces::get());
        $size_sellers = count(Sellers::get());

        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'zip_code' => fake()->numerify('#####'),
            'province_id' => Provinces::find(rand(1, $size_provinces)),
            'seller_id' => Sellers::find(rand(1, $size_sellers))
        ];
    }

}
