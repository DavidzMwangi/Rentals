<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class LandLord extends Model
{
    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
