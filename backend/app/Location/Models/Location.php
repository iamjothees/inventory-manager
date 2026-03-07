<?php

namespace App\Location\Models;

use App\Address\Models\Address;
use App\Location\Database\Factories\LocationFactory;
use App\Locations\Model\LocationContactPerson;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    /** @use HasFactory<\Database\Factories\LocationFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'code'];

    protected static function newFactory()
    {
        return LocationFactory::new();
    }

    public function address()
    {
        return $this->morphOne(Address::class,'addressable');
    }

    public function contactPersons(){
        return $this->belongsToMany(User::class)
            ->using(LocationContactPerson::class);
    }
}
