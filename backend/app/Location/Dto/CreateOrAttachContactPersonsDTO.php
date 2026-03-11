<?php

namespace App\Location\Dto;

use Spatie\LaravelData\Data;

class CreateOrAttachContactPersonsDTO extends Data
{
    public function __construct(
        public array $contactPersons
    ) {
        foreach ($this->contactPersons as $contactPerson) {
            if ($contactPerson instanceof CreateContactPersonDTO) continue;
            if (\is_int($contactPerson)) continue;

            throw new \Exception('Invalid contact person');
        }
    }
}