<?php

namespace App\Address\Dto;

use Spatie\LaravelData\Data;

class AttachAddressDTO extends Data
{
    public function __construct(
        public string $line1,
        public ?string $line2,
        public string $city,
        public string $state,
        public string $zipcode,
        public string $country,
        public ?CoordinatesDTO $coordinates = null,
    ) {
    }
}
