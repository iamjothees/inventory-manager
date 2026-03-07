<?php

namespace App\Address\Models;

use App\Address\Database\Factories\AddressFactory;
use App\Address\Enums\OwnerTypeEnum;
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
        'addressable_type' => OwnerTypeEnum::class,
        'coordinates' => 'array', 
    ];

    protected static function newFactory()
    {
        return AddressFactory::new();
    }

    public function getOwnerAttrubute(): array{
        return [
            'id' => $this->addressable_id,
            'type' => $this->addressable_type,

        ];
    }

    public function addressable(): MorphTo
    {
        return $this->morphTo();
    }
}
