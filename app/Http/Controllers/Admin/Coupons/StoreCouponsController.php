<?php

namespace App\Http\Controllers\Admin\Coupons;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class StoreCouponsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $coupon = Coupon::create([
            'code' => $request->string('code'),
            'type' => $request->string('type'),
            'value' => $request->string('value'),
            'min_order_amount' => $request->string('min_order_amount'),
            'is_disposable' => $request->boolean('is_disposable'),
            'usage_limit' => $request->integer('usage_limit'),
            'used_count' => $request->integer('used_count'),
        ]);

        if ($request->filled('sub_category_id')) {
            $coupon->subCategories()->attach($request->string('sub_category_id'));
        }
        if ($request->filled('product_id')) {
            $coupon->products()->attach($request->string('product_id'));
        }

        return redirect()->route('admin.coupons.list');
    }
}
