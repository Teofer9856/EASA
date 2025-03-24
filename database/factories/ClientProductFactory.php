<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ClientProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $size_provinces = count(Client::get());
        $size_products = count(Product::get());

        return [
            'client_id' => Client::find(rand(1, $size_provinces)),
            'product_id' => Product::find(rand(1, $size_products)),
            'price' => fake()->randomFloat(2, 0, 9999)
        ];
    }
}
