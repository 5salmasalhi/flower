<?php

namespace Database\Factories;

use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
{
    protected $model = OrderItem::class;

    public function definition()
    {
        return [
            'order_id' => null, // sera assigné dans le seeder
            'product_id' => null, // sera assigné dans le seeder
            'name' => $this->faker->words(2, true),
            'price' => $this->faker->randomFloat(2, 5, 150),
            'quantity' => $this->faker->numberBetween(1, 5),
            'subtotal' => 0, // sera calculé dans le seeder
        ];
    }
}
