<?php

namespace App\Address\Enums;

enum AddressableTypeEnum: string
{
    case USER = 'user';
    case LOCATION = 'location';
}
