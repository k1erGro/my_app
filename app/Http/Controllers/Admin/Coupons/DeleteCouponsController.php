<?php

namespace App\Http\Controllers\Admin\Coupons;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DeleteCouponsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Coupon $coupon)
    {
        try {
            DB::transaction(function () use ($request, $coupon) {
                $coupon->delete();
            });
            return back()->with('success', 'Купон успешно удален');
        } catch (\Exception $e) {
            return back()->withErrors([$e->getMessage()]);
        }
    }
}
