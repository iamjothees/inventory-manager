<?php

namespace App\Location\Services;

use App\Address\Services\AddressService;
use App\Location\Dto\CreateLocationDTO;
use App\Location\Dto\DeleteLocationDTO;
use App\Location\Dto\UpdateLocationDTO;
use App\Location\Models\Location;
use Illuminate\Database\Eloquent\Collection;

class LocationService
{
    public function __construct(private AddressService $addressService){}

    public function getAllLocations(): Collection
    {
        return Location::all();
    }

    public function getLocation(int $id): Location
    {
        return Location::find($id);
    }

    public function createLocation(CreateLocationDTO $dto): Location
    {
        $location = Location::create($dto->toArray());
        $this->addressService->attachAddress( $dto->address, $location->id, 'location' );
        return $location->load('address');
    }

    public function updateLocation(UpdateLocationDTO $dto): Location
    {
        $location = Location::find($dto->id);
        $location->update($dto->toArray());
        return $location;
    }

    public function deleteLocation(DeleteLocationDTO $dto): void
    {
        Location::find($dto->id)->delete();
    }
}
