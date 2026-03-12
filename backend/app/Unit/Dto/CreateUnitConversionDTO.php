<?php

namespace App\Unit\Dto;

use App\Unit\Enums\UnitConversionPrecision;
use Spatie\LaravelData\Data;

class CreateUnitConversionDTO extends Data
{
    public function __construct(
        public readonly int $unit_id,
        public readonly int $to_unit_id,
        public readonly float $value,
        public readonly UnitConversionPrecision $precision,
    ) {}
}