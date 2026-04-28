<?php

namespace App\Models;

use App\Traits\SlugTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Property extends Model
{
    use HasFactory, SlugTrait;
    protected $fillable = [
        'name',
        'slug',
    ];

    public function getName(): string
    {
        return $this->name;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function propertyValues(): hasMany
    {
        return $this->hasMany(PropertyValue::class);
    }
}
