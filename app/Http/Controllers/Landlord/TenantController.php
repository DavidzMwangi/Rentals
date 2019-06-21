<?php

namespace App\Http\Controllers\Landlord;

use App\Models\Apartment;
use App\Models\LandLord;
use App\Models\RoomNumber;
use App\Models\Tenant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TenantController extends Controller
{
    public function tenants()
    {
        $landlord=LandLord::where('user_id',Auth::id())->first();
        return view('backend.landlord.tenants.index')->withApartments(Apartment::where('landlord_id',$landlord->id)->get());
    }

    public function getOccupiedRooms($building_id)
    {
        //            'rooms'=>RoomNumber::where('building_id',$building_id)->get()->load('building'),
        $rooms=RoomNumber::where(['building_id'=>$building_id,'is_vacant'=>false])->pluck('id');

        $tenants=Tenant::whereIn('room_number_id',$rooms)->get()->load(['user','room']);
        return response()->json([
            'tenants'=>$tenants
        ]);
    }
}
