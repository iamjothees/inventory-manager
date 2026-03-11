<?php

namespace App\Location\Database\Factories;

use App\Location\Models\ContactPerson;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Location\Models\ContactPerson>
 */
class ContactPersonFactory extends Factory
{
    protected $model = ContactPerson::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
        ];
    }
}
