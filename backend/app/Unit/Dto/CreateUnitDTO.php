<?php

namespace App\Unit\Dto;

use App\Unit\Enums\StandardUnit;
use Spatie\LaravelData\Data;

class CreateUnitDTO extends Data
{
    public function __construct(
        public readonly StandardUnit $standard_unit,
        public readonly string $name,
        public readonly string $short_code,
        public readonly string $icon,
        public readonly int $decimal_precision,
        public readonly array $conversions = [],
    ) {
        
    }

    public function toCreateConversionDTOs(int $unitId): array{
        return array_map(fn($conversion) => CreateUnitConversionDTO::from([...$conversion, 'unit_id' => $unitId]), $this->conversions);
    }
}