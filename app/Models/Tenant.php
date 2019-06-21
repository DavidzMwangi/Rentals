<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    public function User()
    {
        return $this->hasOne(User::class,'id','user_id');
    }

    public function Room()
    {
        return $this->hasOne(RoomNumber::class,'id','room_number_id');
    }
}
