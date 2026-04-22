<?php

namespace App\Enums;

enum RoleEnum: string
{
    case ADMIN = 'admin';
    case USER = 'user';
    case GUEST = 'guest';

    public function label(): string
    {
        return match ($this) {
            static::ADMIN => 'Admin',
            static::USER => 'User',
            static::GUEST => 'Guest',
        };
    }
}
