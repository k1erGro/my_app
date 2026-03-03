<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait SlugTrait
{
    protected static function bootSlugTrait()
    {
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->name) . '-' . rand(1000,9999);
            }
        });
    }
}
