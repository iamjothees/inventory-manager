<?php

namespace App\Location\Dto;

use App\Address\Dto\AttachAddressDTO;
use Spatie\LaravelData\Data;

class CreateLocationDTO extends Data
{
    public function __construct(
        public string $name,
        public string $code,
        public AttachAddressDTO $address
    ) { }
}
