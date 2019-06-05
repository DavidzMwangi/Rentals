<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    public function Location()
    {
        return $this->belongsTo(Location::class);
    }

    public function Landlord()
    {
        return $this->belongsTo(LandLord::class);
    }
}
