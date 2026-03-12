<?php

use App\Address\Dto\AttachAddressDTO;
use App\Location\Dto\CreateLocationDTO;
use App\Location\Dto\CreateOrAttachContactPersonsDTO;
use App\Location\Dto\DeleteLocationDTO;
use App\Location\Dto\UpdateLocationDTO;
use App\Location\Models\ContactPerson;
use App\Location\Models\Location;
use App\Location\Services\LocationService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

beforeEach(function () {
    $this->locationService = app(LocationService::class);
});

test('create location with address', function () {
    $locationDto = $this->locationService->createLocation(new CreateLocationDTO(
        'Location 1',
        'code L1',
        AttachAddressDTO::from([
            'line1' => '123 Main St',
            'line2' => 'Apt 4B',
            'city' => 'New York',
            'state' => 'NY',
            'zipcode' => '10001',
            'country' => 'USA',
        ]),
    ));
    expect($locationDto)->toBeInstanceOf(Location::class);
});

test("create location and attach new contact person and existing contact person", function () {
    $contactPerson1 = ContactPerson::factory()->create();
    $contactPerson2 = ContactPerson::factory()->create();

    $locationDto = $this->locationService->createLocation(new CreateLocationDTO(
        'Location 1',
        'code L1',
        AttachAddressDTO::from([
            'line1' => '123 Main St',
            'line2' => 'Apt 4B',
            'city' => 'New York',
            'state' => 'NY',
            'zipcode' => '10001',
            'country' => 'USA',
        ]),
        CreateOrAttachContactPersonsDTO::from([
            'contactPersons' => [
                // CreateContactPersonDTO::from([ 'name' => 'John Doe' ]),
                $contactPerson1->id,
                $contactPerson2->id
            ]
        ])
    ));
    expect($locationDto)->toBeInstanceOf(Location::class);
});

test('update location', function () {
    $location = Location::factory()->create();
    $dto = UpdateLocationDTO::from($location);
    $dto->code = "TEST";
    $this->locationService->updateLocation($dto);
    expect($location->refresh()->code)->toBe("TEST");
});

test('delete location', function () {
    $location = Location::factory()->create();
    $dto = DeleteLocationDTO::from($location);
    $this->locationService->deleteLocation($dto);
    expect(Location::find($location->id))->toBeNull();
});

test('get all locations', function () {
    Location::factory()->count(3)->create();

    $locations = $this->locationService->getAllLocations();
    
    expect($locations)->toBeInstanceOf(Collection::class);
    expect($locations)->toHaveCount(3);
});

test('get specific location', function () {
    $location = Location::factory()->create();

    $locationFromService = $this->locationService->getLocation($location->id);
    
    expect($locationFromService)->toBeInstanceOf(Location::class);
    expect($locationFromService->id)->toBe($location->id);
});
