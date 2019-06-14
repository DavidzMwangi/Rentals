<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    public function Apartment()
    {
        return $this->hasOne(Apartment::class,'id','apartment_id');
    }
}
