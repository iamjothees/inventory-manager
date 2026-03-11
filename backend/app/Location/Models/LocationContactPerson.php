<?php

namespace App\Location\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class LocationContactPerson extends Pivot
{
    protected $table = "location_contact_person";

    protected $fillable = [
        'location_id',
        'contact_person_id',
    ];
}
