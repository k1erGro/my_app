<?php

namespace Database\Factories;

use App\Models\PropertyValue;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PropertyValue>
 */
class PropertyValueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'property_id' => $this->faker->numberBetween(1, 100),
            'product_id' => $this->faker->numberBetween(1, 200),
            'value' => $this->faker->name(),
        ];
    }
}
