<?php

namespace App\Location\Models;

use App\Location\Database\Factories\ContactPersonFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ContactPerson extends Model
{
    use HasFactory;

    protected $table = "contact_persons";

    protected $fillable = [ 'name', ];

    protected static function newFactory()
    {
        return ContactPersonFactory::new();
    }

    public function locations(): BelongsToMany
    {
        return $this->belongsToMany(Location::class)
                    ->using(LocationContactPerson::class);
    }
}
