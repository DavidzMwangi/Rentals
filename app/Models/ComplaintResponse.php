<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComplaintResponse extends Model
{
    public function Complaint()
    {
        return $this->hasOne(Complaint::class,'id','complaint_id');
    }
}
