<?php

namespace App\Http\Controllers\Tenant;

use App\Models\Building;
use App\Models\RoomNumber;
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

    public function getBuildingApartments($apartment_id)
    {
        return response()->json([
            'buildings'=>Building::where('apartment_id',$apartment_id)->get()
        ]);
    }

    public function getRoomsBuilding($building_id)
    {
        return response()->json([
            'rooms'=>RoomNumber::where('building_id',$building_id)->get()->load('building'),
        ]);
    }

}
