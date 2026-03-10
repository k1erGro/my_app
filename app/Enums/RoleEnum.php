<?php

namespace App\Enums;

enum RoleEnum: int
{
    case ADMIN = 2;
    case USER = 1;
    case GUEST = 0;
}
