<?php

namespace App\Address\Dto;

use Spatie\LaravelData\Data;


class UpdateAddressDTO extends Data
{
    public function __construct(
        public int $id,
        public string $line1,
        public ?string $line2,
        public string $city,
        public string $state,
        public string $zipcode,
        public string $country,
        public ?CoordinatesDTO $coordinates,
    ) {
        //
    }
}
