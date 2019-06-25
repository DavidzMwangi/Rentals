<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Damage extends Model
{
    public function Tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function Room()
    {
        return $this->hasOne(RoomNumber::class,'id','room_number_id');
    }
}
