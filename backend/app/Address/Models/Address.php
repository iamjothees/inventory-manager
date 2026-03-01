<?php

namespace App\Address\Models;

use App\Address\Database\Factories\AddressFactory;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        "addressable_id",
        "addressable_type",
        "line1",
        "line2",
        "city",
        "state",
        "zipcode",
        "country",
        "coordinates",
    ];

    protected $casts = [
        'coordinates' => AsArrayObject::class, 
    ];

    protected static function newFactory()
    {
        return AddressFactory::new();
    }

    public function addressable(): MorphTo
    {
        return $this->morphTo();
    }
}
