<?php

namespace App\Http\Controllers\Admin\Coupons;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class UpdateCouponsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Coupon $coupon)
    {
        $coupon->update([
            'code' => $request->string('code'),
            'type' => $request->string('type'),
            'value' => $request->string('value'),
            'min_order_amount' => $request->string('min_order_amount'),
            'is_disposable' => $request->boolean('is_disposable'),
            'usage_limit' => $request->integer('usage_limit'),
            'used_count' => $request->integer('used_count'),
        ]);

        if ($request->filled('sub_category_id')) {
            $coupon->subCategories()->sync($request->string('sub_category_id'));
        }
        if ($request->filled('product_id')) {
            $coupon->products()->sync($request->string('product_id'));
        }

        return redirect()->route('admin.coupons.list');
    }
}
