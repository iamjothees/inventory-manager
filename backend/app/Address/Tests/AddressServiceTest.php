<?php

namespace App\Address\Tests;

use App\Address\Dto\CreateAddressDTO;
use App\Address\Dto\DeleteAddressDTO;
use App\Address\Dto\UpdateAddressDTO;
use App\Address\Enums\OwnerTypeEnum;
use App\Address\Models\Address;
use App\Models\User;
use App\Address\Services\AddressService;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(TestCase::class, RefreshDatabase::class);

beforeEach(function () {
    $this->addressService = new AddressService();
});

test('create address', function () {
    $address = $this->addressService->createAddress(CreateAddressDTO::from([
        'addressable_id' => 1,
        'addressable_type' => OwnerTypeEnum::from('user'),
        'line1' => '123 Main St',
        'line2' => 'Apt 4B',
        'city' => 'New York',
        'state' => 'NY',
        'zipcode' => '10001',
        'country' => 'USA',
    ]));
    expect($address)->toBeInstanceOf(Address::class);
});

test('create address with coordinates', function () {
    $address = $this->addressService->createAddress(CreateAddressDTO::from([
        'addressable_id' => 1,
        'addressable_type' => OwnerTypeEnum::from('user'),
        'line1' => '123 Main St',
        'line2' => 'Apt 4B',
        'city' => 'New York',
        'state' => 'NY',
        'zipcode' => '10001',
        'country' => 'USA',
        'coordinates' => [
            'latitude' => 40.7128,
            'longitude' => -74.0060,
        ],
    ]), 1, 'user');
    expect($address)->toBeInstanceOf(Address::class);
    expect($address->coordinates)->toBeArray();
});

test('update address', function () {
    $address = User::factory()
                    ->has(Address::factory())
                    ->create()->addresses->first();
    $address->country = 'India';
    $dto = UpdateAddressDTO::from($address);
    $address = $this->addressService->updateAddress($dto);
    
    expect($address)->toBeInstanceOf(Address::class);
    expect($address->country)->toBe('India');
});

test('delete address', function () {
    $address = User::factory()
                    ->has(Address::factory())
                    ->create()->addresses->first();
    $this->addressService->deleteAddress(DeleteAddressDTO::from($address));
    expect($address->fresh())->toBeNull();
});