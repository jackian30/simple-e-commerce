<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        $productName = $this->faker->word . ' ' . $this->faker->word;

        return [
            'name' => $productName,
            'slug' => str_replace(' ', '-', $productName),
            'details' => $this->faker->paragraph(2),
            'price' => $this->faker->numberBetween(500, 8000),
            'description' => $this->faker->paragraph(8),
        ];
    }
}
