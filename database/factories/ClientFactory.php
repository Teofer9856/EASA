<?php

namespace Database\Factories;

use App\Models\Province;
use App\Models\Seller;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Clients>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $size_provinces = count(Province::get());
        $size_sellers = count(Seller::get());

        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'zip_code' => fake()->numerify('#####'),
            'province_id' => Province::find(rand(1, $size_provinces)),
            'seller_id' => Seller::find(rand(1, $size_sellers))
        ];
    }

}
