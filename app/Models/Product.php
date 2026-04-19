<?php

namespace App\Models;

use App\Contracts\ProductInterface;
use App\Traits\SlugTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
        'specs',
        'category_id',
    ];

    protected $casts = [
        'specs' => 'array',
        'price' => 'decimal:2',
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
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

    public function getSpecs(): array
    {
        return $this->specs;
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Fit::Contain, 300, 300)
            ->nonQueued();
    }

}
