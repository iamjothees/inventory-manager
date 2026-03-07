<?php

namespace App\Location\Dto;

use Spatie\LaravelData\Data;

class DeleteLocationDTO extends Data
{
    public function __construct(
        public int $id
    ) {
    }
}