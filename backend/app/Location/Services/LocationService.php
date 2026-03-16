<?php

namespace App\Location\Services;

use App\Address\Services\AddressService;
use App\Location\Dto\CreateContactPersonDTO;
use App\Location\Dto\CreateLocationDTO;
use App\Location\Dto\DeleteLocationDTO;
use App\Location\Dto\UpdateLocationDTO;
use App\Location\Models\ContactPerson;
use App\Location\Models\Location;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Queue\SerializesModels;

class LocationService
{
    use SerializesModels;

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
        // attachAddress
        $this->addressService->attachAddress( $dto->address, $location->id, 'location' );
        // attachContactPersons
        foreach ($dto->contactPersonsDto->contactPersons as $contactPerson) {
            if ($contactPerson instanceof CreateContactPersonDTO) {
                $contactPersonId = $this->createContactPerson($contactPerson)->id;
            }else {
                $contactPersonId = $contactPerson;
            }
            $this->attachContactPerson($contactPersonId, $location);
        }
        return $location->loadMissing(['address', 'contactPersons']);
    }

    public function updateLocation(UpdateLocationDTO $dto): Location
    {
        $location = Location::find($dto->id);
        $location->update($dto->toArray());
        return $location;
    }

    public function deleteLocation(int $id): void
    {
        Location::findOrFail($id)->delete();
    }

    public function createContactPerson(CreateContactPersonDTO $dto): ContactPerson
    {
        return ContactPerson::create($dto->toArray());
    }

    public function attachContactPerson(int $contactPersonId, Location|int $location): void
    {
        if (!($location instanceof Location)) {
            if (!Location::find($location)){
                dd($location);
            }
            $location = Location::findOrFail($location);
        }
        $location->contactPersons()->attach($contactPersonId);
    }

    public function detachContactPerson(int $locationId, int $contactPersonId): void
    {
        Location::find($locationId)->contactPersons()->detach($contactPersonId);
    }
}
