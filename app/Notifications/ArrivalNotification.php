<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ArrivalNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $product;
    public function __construct($product)
    {
        $this->product = $product;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'type' => 'product_arrival',
            'product_id' => $this->product->id,
            'product_slug' => $this->product->slug,
            'product_name' => $this->product->name,
        ];
    }
}
