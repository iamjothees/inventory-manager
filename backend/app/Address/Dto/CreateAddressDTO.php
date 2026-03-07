<?php

namespace App\Address\Dto;

use App\Address\Enums\OwnerTypeEnum;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;

class CreateAddressDTO extends Data
{
    public function __construct(
        public int $addressable_id,
        public OwnerTypeEnum $addressable_type,
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
