<?php

namespace App\Location\Dto;

use Spatie\LaravelData\Data;

class CreateContactPersonDTO extends Data
{
    public function __construct(
        public string $name,
        public ?string $email,
        public ?string $phone,
    ) {}
}
