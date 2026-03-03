<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

interface ProductInterface
{
    public function category(): BelongsTo;
    public function getName(): string;
    public function getDescription(): string;
    public function getPrice(): string;
    public function getSlug(): string;
    public function getSpecs(): array;
}
