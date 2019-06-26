<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    public function Room()
    {
        return $this->hasOne(RoomNumber::class,'id','room_number_id');
    }
}
