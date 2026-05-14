<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class EntranceNotification extends Notification implements ShouldQueue
{
    use Queueable;

    private $product;
    public function __construct($product)
    {
        $this->product = $product;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase($notifiable): array
    {
        return[
            'type' => 'product_entrance',
            'product_id' => $this->product->id,
            'product_slug' => $this->product->slug,
            'product_name' => $this->product->name,
            'price' => $this->product->price,
        ];
    }

}
