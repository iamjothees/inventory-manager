<?php

namespace App\Address\Services;

use App\Address\Dto\AddressDTO;
use App\Address\Dto\AttachAddressDTO;
use App\Address\Dto\CreateAddressDTO;
use App\Address\Dto\DeleteAddressDTO;
use App\Address\Dto\UpdateAddressDTO;
use App\Address\Enums\OwnerTypeEnum;
use App\Address\Models\Address;

class AddressService
{
    public function createAddress(CreateAddressDTO $createAddressDTO): Address{
        return Address::create($createAddressDTO->toArray());
    }

    public function attachAddress(AttachAddressDTO $attachAddressDTO, int $attachable_id, string $attachable_type): Address{
        $attachable_type = OwnerTypeEnum::from($attachable_type);
        return $this->createAddress(CreateAddressDTO::from([
            'addressable_id' => $attachable_id,
            'addressable_type' => $attachable_type,
            ...$attachAddressDTO->toArray()
        ]));
    }

    public function updateAddress(UpdateAddressDTO $updateAddressDTO): Address
    {
        $address = Address::find($updateAddressDTO->id);
        $address->update($updateAddressDTO->toArray());
        return $address;
    }

    public function deleteAddress(DeleteAddressDTO $deleteAddressDTO): void
    {
        Address::find($deleteAddressDTO->id)->delete();
    }
}
