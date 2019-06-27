<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rent extends Model
{
    public function Tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
