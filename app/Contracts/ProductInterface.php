<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

interface ProductInterface
{
    public function categories(): BelongsTo;
    public function getName(): string;
    public function getDescription(): string;
    public function getPrice(): string;
    public function getSlug(): string;
}
