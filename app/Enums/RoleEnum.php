<?php

namespace App\Enums;

enum RoleEnum: string
{
    case ADMIN = 'Admin';
    case USER = 'User';
    case GUEST = 'Guest';
    case TECHNICALSPECIALIST = 'TechnicalSpecialist';
    case DIRECTOR = 'Director';
    case MANAGER = 'Manager';

    public function label(): string
    {
        return match ($this) {
            static::ADMIN => 'Admin',
            static::USER => 'User',
            static::GUEST => 'Guest',
            static::TECHNICALSPECIALIST => 'TechnicalSpecialist',
            static::DIRECTOR => 'Director',
            static::MANAGER => 'Manager',
        };
    }
}
