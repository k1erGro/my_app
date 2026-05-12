<?php

namespace App\Http\Controllers\Coupons;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function Sodium\increment;

class ApplyCouponController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Order $order)
    {

        $coupon = Coupon::where('code', $request->string('coupon'))->first();

        if (!$coupon) {
            return back()->withErrors('Купон не найден');
        }
        if ($order->getTotalPrice() < $coupon->getMinOrderAmount()) {
            return back()->withErrors('Сумма заказа слишком мала');
        }
        if ($coupon->getUsedCount() >= $coupon->getUsageLimit()) {
            return back()->withErrors('Купон исчерпан');
        }
        $usedCoupon = $order->getUser()->coupons()->where('coupon_id', $coupon->getKey())->exists();

        if ($coupon->getIsDisposable() && $usedCoupon) {
            return back()->withErrors('Вы уже использовали этот купон');
        }

        $discount = 0;
        if ($coupon->getType() == 'percent') {
            $discount = $order->getTotalPrice() * ($coupon->getValue() / 100);
        } else {
            $discount = $coupon->getValue();
        }
        $order->update([
            'coupon_id' => $coupon->getKey(),
            'total_price' => $order->getTotalPrice() - $discount,
        ]);

        $userId[] = $order->getUser()->getKey();
        $coupon->users()->attach($userId);
        $coupon->increment('used_count');

        return back()->with('success', 'Купон применен');
    }
}
