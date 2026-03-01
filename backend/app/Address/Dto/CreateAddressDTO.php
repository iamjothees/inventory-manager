<?php

namespace App\Address\Dto;

use App\Address\Enums\AddressableTypeEnum;
use App\Models\Address;
use Illuminate\Validation\Rule;
use Spatie\LaravelData\Attributes\MergeValidationRules;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\ValidationContext;

#[MergeValidationRules]
class CreateAddressDTO extends Data
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public int $addressable_id,
        public AddressableTypeEnum $addressable_type,
        public string $line1,
        public ?string $line2,
        public string $city,
        public string $state,
        public string $zipcode,
        public string $country,
        public ?CoordinatesDTO $coordinates = null,
    ) {
    }
    
    public static function rules(?ValidationContext $context = null): array
    {
        return [
            'line1' => ['max:255'],
            'line2' => ['max:255'],
        ];
    }
}
