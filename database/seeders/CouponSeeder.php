<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $coupons = [
            ['code' => 'disc20', 'type' => 'percent', 'value' => '20', 'min_order_amount' => 1000, 'is_disposable' => 1],
        ];

        foreach ($coupons as $coupon) {
            Coupon::create([
                'code' => $coupon['code'],
                'type' => $coupon['type'],
                'value' => $coupon['value'],
                'min_order_amount' => $coupon['min_order_amount'],
                'is_disposable' => $coupon['is_disposable'],
            ]);
        }
    }
}
