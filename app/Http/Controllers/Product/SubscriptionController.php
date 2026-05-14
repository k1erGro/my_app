<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Subscription\SubscriptionRequest;
use App\Models\Product;
use App\Models\ProductSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(SubscriptionRequest $request, Product $product)
    {
        ProductSubscription::create([
            'user_id' => Auth::user()->getKey(),
            'product_id' => $product->getKey(),
        ]);
        return back()->with('message', 'Вы подписались на уведомление о появлении товара');
    }
}
