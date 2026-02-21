<?php

namespace App\Traits;

use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Hash;

trait UserTrait
{
    public function fullName(): Attribute
    {
        return Attribute::make(
            get: fn () => "{$this->l_name} {$this->f_name} {$this->m_name}",
        );
    }

    public function isAdmin(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getRole() === UserRole::ADMIN,
        );
    }

    public function password(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => Hash::make($value),
        );
    }
}
