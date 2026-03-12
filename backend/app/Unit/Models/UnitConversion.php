<?php

namespace App\Unit\Models;

use App\Unit\Database\Factories\UnitConversionFactory;
use App\Unit\Enums\UnitConversionPrecision;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitConversion extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'unit_id',
        'to_unit_id',
        'value',
        'precision',
    ];

    protected $casts = [
        'precision' => UnitConversionPrecision::class,
        'value' => 'integer',
    ];

    protected static function newFactory()
    {
        return UnitConversionFactory::new();
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function toUnit()
    {
        return $this->belongsTo(Unit::class, 'to_unit_id');
    }
}
