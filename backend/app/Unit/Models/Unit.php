<?php

namespace App\Unit\Models;

use App\Unit\Database\Factories\UnitFactory;
use App\Unit\Enums\StandardUnit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    /** @use HasFactory<App\Unit\Database\Factories\UnitFactory> */
    use HasFactory;

    protected $fillable = [
        "standard_unit",
        "name",
        "short_code",
        "icon",
        "decimal_precision",
    ];

    protected $casts = [
        "standard_unit" => StandardUnit::class,
    ];

    protected static function newFactory()
    {
        return UnitFactory::new();
    }

    public function conversions()
    {
        return $this->hasMany(UnitConversion::class);
    }
}
