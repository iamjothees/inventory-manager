<?php

namespace App\Address\Dto;

use Spatie\LaravelData\Data;

class AddressDTO extends Data
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public int $id,
        public int $addressable_id,
        public string $addressable_type,
        public string $line1,
        public ?string $line2,
        public string $city,
        public string $state,
        public string $zipcode,
        public string $country,
        public ?CoordinatesDTO $coordinates,
    )
    {
        //
    }
}
