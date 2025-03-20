<?php

namespace Database\Factories;

use App\Models\Clients;
use App\Models\Products;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ClientsProductsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $size_provinces = count(Clients::get());
        $size_products = count(Products::get());

        return [
            'client_id' => Clients::find(rand(1, $size_provinces)),
            'product_id' => Products::find(rand(1, $size_products)),
            'price' => fake()->randomFloat(2, 0, 9999)
        ];
    }
}
