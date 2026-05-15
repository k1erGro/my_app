<?php

namespace App\Service;

use YooKassa\Client;

class PaymentService
{
    private function getClient(): Client
    {
        $client = new Client();
        $client->setAuth(config('yookassa.shop_id'), config('yookassa.secret_key'));
        return $client;
    }

    public function createPayment(float $amount, string $description, array $options = [])
    {
        $client = $this->getClient();

        $metadata = [
            'transaction_id' => $options['transaction_id'] ?? null,
        ];
        if (isset($options['order_id'])) {
            $metadata['order_id'] = $options['order_id'];
        }

        $paymentData = [
            'amount' => [
                'value' => $amount,
                'currency' => 'RUB',
            ],
            'capture' => true,
            'confirmation' => [
                'type' => 'redirect',
                'return_url' => $options['return_url'] ?? route('payment.callback'),
            ],
            'metadata' => $metadata,
            'description' => $description,
        ];

        $payment = $client->createPayment($paymentData, uniqid('', true));
        return $payment->getConfirmation()->getConfirmationUrl();
    }
}
