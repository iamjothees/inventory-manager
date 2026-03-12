<?php

namespace App\Unit\Dto;

use App\Unit\Enums\StandardUnit;
use Spatie\LaravelData\Data;

class UpdateUnitDTO extends Data
{
    public function __construct(
        public readonly int $id,
        public readonly StandardUnit $standard_unit,
        public readonly string $name,
        public readonly string $short_code,
        public readonly string $icon,
        public readonly int $decimal_precision
    ) {}
}