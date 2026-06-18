<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
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
        return ['database', 'mail'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'type' => 'product_entrance',
            'product_id' => $this->product->id,
            'product_slug' => $this->product->slug,
            'product_name' => $this->product->name,
            'price' => $this->product->price,
        ];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $url = url('/products/' . $this->product->slug);

        return (new MailMessage)
            ->subject('Поступление нового товара!')
            ->greeting('Здравствуйте!')
            ->line('В продажу поступил новый товар: **' . $this->product->name . '**.')
            ->line('Текущая цена: **' . number_format($this->product->price, 2, ',', ' ') . ' руб.**')
            ->action('Посмотреть на сайте', $url)
            ->line('Спешите оформить заказ, пока товар есть в наличии!');
    }

}
