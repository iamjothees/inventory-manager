<?php

namespace App\Address\Enums;

use App\Location\Models\Location;
use App\Models\User;

enum OwnerTypeEnum: string
{
    case USER = 'user';
    case LOCATION = 'location';

    public function getClassName(): string
    {
        return match ($this) {
            self::USER => User::class,
            self::LOCATION => Location::class,
        };
    }
}
