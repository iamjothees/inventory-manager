<?php

namespace App\Unit\Services;

use App\Unit\Dto\CreateUnitConversionDTO;
use App\Unit\Dto\CreateUnitDTO;
use App\Unit\Dto\UpdateUnitConversionDTO;
use App\Unit\Dto\UpdateUnitDTO;
use App\Unit\Models\Unit;
use App\Unit\Models\UnitConversion;

class UnitService
{
    public function create(CreateUnitDTO $dto): Unit
    {
        $unit = Unit::create($dto->toArray());

        foreach ($dto->toCreateConversionDTOs(unitId: $unit->id) as $conversionDto) {
            $this->createConversion($conversionDto);
        }

        return $unit;
    }

    public function update(UpdateUnitDTO $dto): Unit
    {
        $unit = Unit::findOrFail($dto->id);
        $unit->update($dto->toArray());
        return $unit;
    }

    public function delete(int $id): void
    {
        $unit = Unit::findOrFail($id);
        $unit->delete();
    }

    public function createConversion(CreateUnitConversionDTO $dto): UnitConversion
    {
        return UnitConversion::create($dto->toArray());
    }

    public function updateConversion(UpdateUnitConversionDTO $dto): UnitConversion
    {
        $unitConversion = UnitConversion::findOrFail($dto->id);
        $unitConversion->update($dto->toArray());
        return $unitConversion;
    }

    public function deleteConversion(int $id): void
    {
        $unitConversion = UnitConversion::findOrFail($id);
        $unitConversion->delete();
    }
}