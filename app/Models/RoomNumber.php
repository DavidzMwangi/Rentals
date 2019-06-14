<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomNumber extends Model
{
    public function Building()
    {
        return $this->hasOne(Building::class,'id','building_id');
    }
}
