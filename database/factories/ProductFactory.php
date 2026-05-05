<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'price' => $this->faker->numberBetween(1000, 999999),
            'description' => $this->faker->text(),
            'category_id' => $this->faker->numberBetween(1, 10),
            'sub_category_id' => $this->faker->numberBetween(1, 53),
        ];
    }
}
