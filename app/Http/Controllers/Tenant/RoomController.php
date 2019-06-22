<?php

namespace App\Http\Controllers\Tenant;

use App\Models\Tenant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    public function roomInfo()
    {
        //get the tenants room info

        $tenant=Tenant::where('user_id',Auth::id())->first()->load(['user','room.building.apartment.location']);
        return view('backend.tenant.room.rooms')->withTenant($tenant);
    }
}
