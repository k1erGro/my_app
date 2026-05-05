<?php

namespace App\Models;

use App\Enums\AddressEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'total_price',
        'address_id',
        'delivery_date',
        'status',
    ];

    protected $casts = [
        'total_price' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'orders_products', 'order_id', 'product_id')->withPivot('quantity', 'price');
    }

    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function orderProducts(): hasMany
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function getOrderProducts(): Collection
    {
        return $this->orderProducts;
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function getAddress(): ?Address
    {
        return $this->address;
    }

    public function getTotalPrice(): string
    {
        return $this->total_price;
    }

    public function setTotalPrice(string $total_price): void
    {
        $this->total_price = $total_price;
    }

    public function getDeliveryDate(): ?string
    {
        return $this->delivery_date;
    }

    public function setDeliveryDate(string $delivery_date): void
    {
        $this->delivery_date = $delivery_date;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }
}
