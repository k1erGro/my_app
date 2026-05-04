<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Collection;

class PropertyValue extends Model
{
    protected $fillable = [
        'property_id',
        'product_id',
        'value',
    ];

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value): void
    {
        $this->value = $value;
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    public function getProperty(): Property
    {
        return $this->property;
    }
}
