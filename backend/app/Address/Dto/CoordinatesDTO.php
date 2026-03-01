<?php

namespace App\Address\Dto;

use Spatie\LaravelData\Data;

class CoordinatesDTO extends Data
{
    public function __construct(
        public float $latitude,
        public float $longitude,
    ) {}
}