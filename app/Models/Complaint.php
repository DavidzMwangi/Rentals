<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    public function Room()
    {
        return $this->hasOne(RoomNumber::class,'id','room_number_id');
    }

    public function Response()
    {
        return $this->hasMany(ComplaintResponse::class,'complaint_id','id');
    }

    public function Tenant()
    {
        return $this->belongsTo(Tenant::class);
    }


}
