<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductImageFactory extends Factory
{
    public function definition(): array
    {
        return [
            'url' => $this->faker->imageUrl(),
            'product_id' => Product::pluck('id')->random(),
        ];
    }
}
