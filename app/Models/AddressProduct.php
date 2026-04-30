<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class AddressProduct extends Pivot
{
    protected $table = 'address_products';

    protected $fillable = [
        'address_id',
        'product_id',
        'product_quantity',
    ];

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public function getAddress(): Address
    {
        return $this->address;
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function getProductQuantity(): int
    {
        return $this->product_quantity;
    }

}
