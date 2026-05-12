<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class Coupon extends Model
{
    protected $fillable = [
        'code',
        'type',
        'value',
        'min_order_amount',
        'is_disposable',
        'usage_limit',
        'used_count',
    ];

    protected $casts = [
        'value' => 'decimal:2',
        'min_order_amount' => 'decimal:2',
        'is_disposable' => 'boolean',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'coupons_users');
    }

    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'coupons_products');
    }

    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function subCategories(): BelongsToMany
    {
        return $this->belongsToMany(SubCategory::class, 'coupons_sub_categories');
    }

    public function getSubCategories(): Collection
    {
        return $this->subCategories;
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function getMinOrderAmount(): string
    {
        return $this->min_order_amount;
    }

    public function getIsDisposable(): bool
    {
        return $this->is_disposable;
    }

    public function getUsageLimit(): ?int
    {
        return $this->usage_limit;
    }

    public function getUsedCount(): int
    {
        return $this->used_count;
    }
}
