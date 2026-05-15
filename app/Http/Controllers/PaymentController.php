<?php

namespace App\Http\Controllers;

use App\Enums\PaymentStatusEnum;
use App\Models\Order;
use App\Models\Transaction;
use App\Service\PaymentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use YooKassa\Model\Notification\NotificationEventType;
use YooKassa\Model\Notification\NotificationSucceeded;

class PaymentController extends Controller
{
    public function pay(Order $order, PaymentService $service)
    {
        $user = Auth::user();
        if ($order->user_id !== $user->getKey()) {
            abort(403);
        }

        if ($order->getStatus() === 'paid') {
            return redirect()->route('orders.show', $order)
                ->with('error', 'Заказ уже оплачен');
        }

        $transaction = Transaction::create([
            'amount' => $order->getTotalPrice(),
            'description' => "Оплата заказа №{$order->getKey()}",
            'status' => PaymentStatusEnum::CREATED,
            'order_id' => $order->getKey(),
            'user_id' => $user->getKey(),
        ]);

        $link = $service->createPayment(
            (float) $order->getTotalPrice(),
            "Оплата заказа №{$order->getKey()}",
            [
                'transaction_id' => $transaction->getKey(),
                'order_id' => $order->getKey(),
                'return_url' => route('orders.show', $order),
            ]
        );

        return redirect()->away($link);
    }

    public function callback(Request $request)
    {
        $source = file_get_contents('php://input');
        $requestBody = json_decode($source, true);

        if (($requestBody['event'] ?? '') === NotificationEventType::PAYMENT_SUCCEEDED) {
            $notification = new NotificationSucceeded($requestBody);
            $payment = $notification->getObject();

            if ($payment->getStatus() === 'succeeded' && $payment->getPaid()) {
                $metadata = $payment->getMetadata();
                $orderId = $metadata['order_id'] ?? null;
                $transactionId = $metadata['transaction_id'] ?? null;

                if ($orderId) {
                    $order = Order::find($orderId);
                    if ($order && $order->getStatus() !== 'paid') {
                        $order->status = 'paid';
                        $order->save();

                        if ($transactionId) {
                            Transaction::where('id', $transactionId)
                                ->update(['status' => PaymentStatusEnum::CONFIRMED]);
                        }
                    }
                }
            }
        }

        return response()->json(['status' => 'ok'], 200);
    }
}
