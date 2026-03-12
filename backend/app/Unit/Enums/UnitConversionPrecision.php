<?php

namespace App\Unit\Enums;

enum UnitConversionPrecision: string
{
    case EXACT = 'exact';
    case APPROX = 'approx';
}