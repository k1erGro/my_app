<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

interface CategoryInterface
{
    public function getName(): string;
    public function getSlug(): string;
    public function getParentId();
    public function parent();
    public function children();
    public function products(): BelongsToMany;
}
