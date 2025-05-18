<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition()
    {
        return [
            'user_id' => null,
            'order_number' => $this->faker->unique()->numerify('ORD-#####'),
            'status' => $this->faker->randomElement(['pending', 'processing', 'completed', 'cancelled']),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'city' => $this->faker->city(),
            'state' => $this->faker->state(),
            'postal_code' => $this->faker->postcode(),
            'country' => $this->faker->country(),
            'payment_method' => $this->faker->randomElement(['card', 'paypal', 'cash']),
            'subtotal' => 0,
            'shipping' => 0,
            'tax' => 0,
            'total' => 0,
            'notes' => $this->faker->optional()->sentence(8),
        ];
    }
}
