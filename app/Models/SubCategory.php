<?php

namespace App\Models;

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

class SubCategory extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SlugTrait;

    protected $fillable = [
        'name',
        'slug',
        'category_id',
    ];

    public function getName(): string
    {
        return $this->name;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function category(): belongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function getCategory(): Category
    {
        return $this->category;
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Fit::Contain, 300, 300)
            ->nonQueued();
    }
}
