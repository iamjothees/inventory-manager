<?php

namespace App\Address\Services;

use App\Address\Dto\AddressDTO;
use App\Address\Dto\CreateAddressDTO;
use App\Address\Dto\DeleteAddressDTO;
use App\Address\Dto\UpdateAddressDTO;
use App\Address\Models\Address;

class AddressService
{
    public function getAllAddresses(){
        return Address::all();
    }

    public function createAddress(CreateAddressDTO $createAddressDTO): AddressDTO{
        $address = Address::create($createAddressDTO->toArray());
        return AddressDTO::from($address);
    }

    public function updateAddress(UpdateAddressDTO $updateAddressDTO): AddressDTO{
        $address = Address::make($updateAddressDTO->toArray());
        $address->id = $updateAddressDTO->id;
        $address->update();
        return AddressDTO::from($address);
    }

    public function deleteAddress(DeleteAddressDTO $deleteAddressDTO): void{
        $address = Address::find($deleteAddressDTO->id);
        $address->delete();
    }
}
