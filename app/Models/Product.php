<?php

namespace App\Models;

use App\Contracts\ProductInterface;
use App\Traits\SlugTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements ProductInterface, HasMedia
{
    use HasFactory, InteractsWithMedia, SlugTrait;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'category_id',
        'subCategory_id',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function categories(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function getCategories(): Category
    {
        return $this->categories;
    }

    public function subCategories(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class, 'subCategory_id', 'id');
    }

    public function getSubCategories(): SubCategory
    {
        return $this->subCategories;
    }

    public function propertyValues(): HasMany
    {
        return $this->hasMany(PropertyValue::class);
    }

    public function getPropertyValues(): Collection
    {
        return $this->propertyValues;
    }

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class);
    }

    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getPrice(): string
    {
        return $this->price;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Fit::Contain, 300, 300)
            ->nonQueued();
    }

}
