<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

interface ProductInterface
{
    public function categories(): BelongsToMany;
    public function getName(): string;
    public function getDescription(): string;
    public function getPrice(): string;
    public function getSlug(): string;
    public function getSpecs(): array;
}
