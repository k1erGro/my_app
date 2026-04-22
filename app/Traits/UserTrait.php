<?php

namespace App\Traits;

use App\Enums\RoleEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Hash;

trait UserTrait
{
    public function getFullName(): string
    {
        return $this->getLastName() . ' ' . $this->getFirstName() . ' ' . $this->getMiddleName();
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
}
