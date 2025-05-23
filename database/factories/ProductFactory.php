<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'name' => $this->faker->words(2, true),
            'slug' => $this->faker->unique()->slug,
            'description' => $this->faker->sentence(10),
            'price' => $this->faker->randomFloat(2, 5, 150),
            'image' => 'products/pocket.webp',
            'stock' => $this->faker->numberBetween(0, 50),
            'is_featured' => $this->faker->boolean(20),
            'is_active' => $this->faker->boolean(90),
            'category_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
