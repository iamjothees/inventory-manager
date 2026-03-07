<?php

namespace App\Location\Database\Factories;

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
            'code' => $this->faker->unique()->slug,
        ];
    }
}
