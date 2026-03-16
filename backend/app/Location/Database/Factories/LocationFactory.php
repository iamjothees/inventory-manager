<?php

namespace App\Location\Database\Factories;

use App\Address\Enums\OwnerTypeEnum;
use App\Address\Models\Address;
use App\Location\Models\ContactPerson;
use App\Location\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Location\Models\Location>
 */
class LocationFactory extends Factory
{
    protected $model = Location::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'code' => $this->faker->unique()->lexify('???'),
        ];
    }

    public function withContactPerson()
    {
        return $this->has(ContactPerson::factory());
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Location $location) {
            ContactPerson::factory()->create()->locations()->attach($location);
            Address::factory()->create([
                'addressable_id' => $location->id,
                'addressable_type' => OwnerTypeEnum::LOCATION,
            ]);
        });
    }
}
