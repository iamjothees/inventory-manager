<?php

namespace App\Address\Database\Factories;

use App\Address\Enums\OwnerTypeEnum;
use App\Address\Models\Address;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Address\Models\Address>
 */
class AddressFactory extends Factory
{
    protected $model = Address::class;

    public function definition(): array
    {
        return [
            'addressable_id' => function ($attributes){
                return $attributes['addressable_type']->getClassName()::factory();
            } ,
            'addressable_type' => $this->faker->randomElement(OwnerTypeEnum::cases())->value,
            'line1' => $this->faker->streetAddress,
            'line2' => $this->faker->secondaryAddress,
            'city' => $this->faker->city,
            'state' => $this->faker->state,
            'zipcode' => $this->faker->postcode,
            'country' => $this->faker->country,
            'coordinates' => [
                'latitude' => $this->faker->latitude,
                'longitude' => $this->faker->longitude,
            ],
        ];
    }
}
