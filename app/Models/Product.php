<?php

namespace App\Models;

use App\Contracts\ProductInterface;
use App\Traits\SlugTrait;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements ProductInterface, HasMedia
{
    use HasFactory, InteractsWithMedia, SlugTrait, SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'category_id',
        'sub_category_id',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    public function getQuestions(): Collection
    {
        return $this->questions;
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function getReviews(): Collection
    {
        return $this->reviews;
    }

    public function coupons(): BelongsToMany
    {
        return $this->belongsToMany(Coupon::class);
    }

    public function getCoupons(): Collection
    {
        return $this->coupons;
    }

    public function subscribedUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'products_subscriptions', 'product_id', 'user_id');
    }

    public function getSubscribedUsers(): Collection
    {
        return $this->subscribedUsers;
    }

    public function categories(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function getCategories(): ?Category
    {
        return $this->categories;
    }

    public function subCategories(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id', 'id');
    }

    public function getSubCategories(): ?SubCategory
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

    public function addresses(): BelongsToMany
    {
        return $this->belongsToMany(Address::class, 'addresses_products', 'product_id', 'address_id')->withPivot('product_quantity');
    }

    public function getAddresses(): Collection
    {
        return $this->addresses;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getPrice(): string
    {
        return $this->price;
    }

    public function setPrice(string $price): void
    {
        $this->price = $price;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Fit::Contain, 300, 300)
            ->nonQueued();
    }

    protected static function booted()
    {
        static::addGlobalScope('activeCategory', function (Builder $builder) {
            $builder->whereHas('subCategories');
        });
    }

    public function scopeSearch(Builder $builder, string $term): Builder
    {
        if (empty($term)) {
            return $builder;
        }
        return $builder->whereRaw("MATCH(name, description) AGAINST(? IN BOOLEAN MODE)",
            [$term . '*']
        );
    }

    public function scopeFilterProducts($builder, array $selectedProperties, $priceFrom = null, $priceTo = null)
    {
        // 1. Фильтр по цене
        if (!empty($priceFrom)) {
            $builder->where('price', '>=', $priceFrom);
        }
        if (!empty($priceTo)) {
            $builder->where('price', '<=', $priceTo);
        }

        // 2. Фильтр по динамическим свойствам
        if (!empty($selectedProperties)) {
            foreach ($selectedProperties as $propertyId => $values) {

                if (empty($values)) {
                    continue;
                }

                $cleanValues = [];

                // Если пришел массив (Livewire может прислать либо ['8 ГБ'], либо ['8 ГБ' => true])
                if (is_array($values)) {
                    foreach ($values as $key => $val) {
                        if ($val === true || $val === 'true') {
                            // Если формат ['8 ГБ' => true], то значение — это $key
                            $cleanValues[] = $key;
                        } elseif (!empty($val) && !is_bool($val)) {
                            // Если формат ['8 ГБ'], то значение — это $val
                            $cleanValues[] = $val;
                        }
                    }
                }
                // Если пришло одиночное значение
                unset($key, $val);

                $cleanValues = array_filter($cleanValues);

                if (!empty($cleanValues)) {
                    $builder->whereHas('propertyValues', function ($query) use ($propertyId, $cleanValues) {
                        $query->where('property_id', $propertyId)
                            ->whereIn('value', $cleanValues);
                    });
                }
            }
        }

        return $builder;
    }
}
