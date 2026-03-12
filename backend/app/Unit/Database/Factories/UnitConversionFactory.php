<?php

namespace App\Unit\Database\Factories;

use App\Unit\Enums\UnitConversionPrecision;
use App\Unit\Models\Unit;
use App\Unit\Models\UnitConversion;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Unit\Models\UnitConversion>
 */
class UnitConversionFactory extends Factory
{
    protected $model = UnitConversion::class;

    public function definition(): array
    {
        return [
            "unit_id" => Unit::factory(),
            "to_unit_id" => Unit::factory(),
            "value" => $this->faker->numberBetween(1, 100),
            "precision" => $this->faker->randomElement(UnitConversionPrecision::class),
        ];
    }
}
