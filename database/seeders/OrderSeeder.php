<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::all();
        Order::factory(20)->create()->each(function ($order) use ($products) {
            $itemsCount = rand(1, 4);
            $subtotal = 0;
            for ($i = 0; $i < $itemsCount; $i++) {
                $product = $products->random();
                $quantity = rand(1, 3);
                $price = $product->price;
                $itemSubtotal = $price * $quantity;
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'price' => $price,
                    'quantity' => $quantity,
                    'subtotal' => $itemSubtotal,
                ]);
                $subtotal += $itemSubtotal;
            }
            $shipping = rand(0, 1) ? 10.00 : 5.00;
            $tax = round($subtotal * 0.15, 2);
            $total = $subtotal + $shipping + $tax;
            $order->update([
                'subtotal' => $subtotal,
                'shipping' => $shipping,
                'tax' => $tax,
                'total' => $total,
            ]);
        });
    }
}
