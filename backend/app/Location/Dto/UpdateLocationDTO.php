<?php

namespace App\Location\Dto;

use Spatie\LaravelData\Data;

class UpdateLocationDTO extends Data
{
    public function __construct(
        public int $id,
        public string $name,
        public string $code
    ) {
    }
}
