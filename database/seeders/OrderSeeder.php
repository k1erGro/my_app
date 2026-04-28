<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders= [
            ['user_id' => 11, 'total_price' => 1123, 'delivery_date' => '2026-04-30', 'address_id' => 1, 'status' => 'completed'],
        ];

        $orderProducts = [
            ['order_id' => 1, 'product_id' => 1, 'price' => 123, 'quantity' => 3],
            ['order_id' => 1, 'product_id' => 2, 'price' => 321, 'quantity' => 3],
            ['order_id' => 1, 'product_id' => 3, 'price' => 321, 'quantity' => 3],
        ];
        foreach ($orders as $order) {
            Order::create(['user_id' => $order['user_id'], 'total_price' => $order['total_price'], 'delivery_date' => $order['delivery_date'], 'address_id' => $order['address_id'], 'status' => $order['status']]);
        }

        foreach ($orderProducts as $orderProduct) {
            OrderProduct::create([
                'order_id' => $orderProduct['order_id'],
                'product_id' => $orderProduct['product_id'],
                'price' => $orderProduct['price'],
                'quantity' => $orderProduct['quantity'],
            ]);
        }

    }
}
