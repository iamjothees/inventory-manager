<?php

namespace App\Unit\Database\Factories;

use App\Unit\Enums\StandardUnit;
use App\Unit\Models\Unit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Unit\Models\Unit>
 */
class UnitFactory extends Factory
{
    protected $model = Unit::class;

    public function definition(): array
    {
        return [
            "standard_unit"=> $this->faker->randomElement(StandardUnit::cases()),
            "name" => $this->faker->unique()->word, 
            "short_code" => $this->faker->unique()->lexify('???'), // Generates unique 3-letter strings
            "icon"=> $this->faker->word,
            "decimal_precision"=> $this->faker->numberBetween(0, 3),
        ];
    }
}
