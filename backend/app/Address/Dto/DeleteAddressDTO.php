<?php

namespace App\Address\Dto;

use Spatie\LaravelData\Dto;

class DeleteAddressDTO extends Dto
{
    public function __construct(
        public int $id
    ) {}
}
