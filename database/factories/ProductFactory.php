<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement([
                'Coca-Cola 2L',
                'Guarana 2L',
                'Agua Mineral 500ml',
                'Suco de Uva 1L',
                'Energetico 473ml',
            ]),
            'description' => fake()->sentence(),
            'quantity' => fake()->numberBetween(5, 80),
            'price' => fake()->randomFloat(2, 3, 30),
            'category_id' => Category::factory(),
        ];
    }
}
