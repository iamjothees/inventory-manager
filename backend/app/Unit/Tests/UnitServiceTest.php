<?php

use App\Unit\Dto\CreateUnitConversionDTO;
use App\Unit\Dto\CreateUnitDTO;
use App\Unit\Dto\UpdateUnitConversionDTO;
use App\Unit\Dto\UpdateUnitDTO;
use App\Unit\Models\Unit;
use App\Unit\Models\UnitConversion;
use App\Unit\Services\UnitService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(TestCase::class, RefreshDatabase::class);

beforeEach(function () {
    $this->unitService = app(UnitService::class);
});

test('can create unit', function () {
    $unit = $this->unitService->create(CreateUnitDTO::from([
        'standard_unit' => 'kilogram',
        'name' => 'Kilogram',
        'short_code' => 'kg',
        'icon' => 'kg',
        'decimal_precision' => 2,
    ]));

    expect($unit)->toBeInstanceOf(Unit::class);
});

test('can update unit', function () {
    $unit = Unit::factory()->create();

    $unit = $this->unitService->update(UpdateUnitDTO::from([
        'id' => $unit->id,
        'standard_unit' => 'kilogram',
        'name' => 'Kilogram',
        'short_code' => 'kg',
        'icon' => 'kg',
        'decimal_precision' => 2,
    ]));

    expect($unit)->toBeInstanceOf(Unit::class);
    expect($unit->name)->toBe('Kilogram');
});

test('can delete unit', function () {
    $unit = Unit::factory()->create();

    $this->unitService->delete($unit->id);

    expect(Unit::find($unit->id))->toBeNull();
});

test('can create unit conversion', function () {
    $unitConversion = $this->unitService->createConversion(CreateUnitConversionDTO::from([
        'unit_id' => Unit::factory()->create()->id,
        'to_unit_id' => Unit::factory()->create()->id,
        'value' => 10,
        'precision' => 'approx',
    ]));

    expect($unitConversion)->toBeInstanceOf(UnitConversion::class);
});

test('can update unit conversion', function () {
    $unitConversion = UnitConversion::factory()->create();

    $unitConversion = $this->unitService->updateConversion(UpdateUnitConversionDTO::from([
        'id' => $unitConversion->id,
        'unit_id' => $unitConversion->unit_id,
        'to_unit_id' => $unitConversion->to_unit_id,
        'value' => 10,
        'precision' => 'exact',
    ]));

    expect($unitConversion)->toBeInstanceOf(UnitConversion::class);
    expect($unitConversion->value)->toBe(10);
});

test('can delete unit conversion', function () {
    $unitConversion = UnitConversion::factory()->create();

    $this->unitService->deleteConversion($unitConversion->id);

    expect(UnitConversion::find($unitConversion->id))->toBeNull();
});

test('can create unit with conversions', function (){
    $unit = $this->unitService->create(CreateUnitDTO::from([
        'standard_unit' => 'kilogram',
        'name' => 'Kilogram',
        'short_code' => 'kg',
        'icon' => 'kg',
        'decimal_precision' => 2,
        'conversions' => [
            [
                'to_unit_id' => Unit::factory()->create()->id,
                'value' => 10,
                'precision' => 'approx',
            ],
            [
                'to_unit_id' => Unit::factory()->create()->id,
                'value' => 50,
                'precision' => 'exact',
            ],
        ],
    ]));

    expect($unit)->toBeInstanceOf(Unit::class);
    expect($unit->conversions)->toHaveCount(2);
});