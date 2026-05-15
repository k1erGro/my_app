<?php

namespace App\Enums;

enum PaymentStatusEnum: string
{
    public const CREATED = 'CREATED';
    public const FAILED = 'FAILED';
    public const CONFIRMED = 'CONFIRMED';
}
