<?php

namespace App\Http\Controllers\Tenant;

use App\Models\Building;
use App\Models\Rent;
use App\Models\RoomNumber;
use App\Models\Tenant;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    public function roomInfo()
    {
        //get the tenants room info

        $tenant=Tenant::where('user_id',Auth::id())->where('is_active',true)->first()->load(['user','room.building.apartment.location']);

        $tenant_br=Tenant::where('user_id',Auth::id())->first();

        //query the amount paid that is confirmed
        $verifiedPaidAmount=Rent::where('tenant_id',$tenant_br->id)->where('is_verified',true)->sum('amount');


        //get the months the user has been in the room
        $months=Carbon::now()->diffInMonths($tenant_br->created_at);


        //get the amount of the room
        $room=RoomNumber::find($tenant_br->room_number_id);



        $a=$room->pricing;
        $b=$months==0?1:$months;

        $total_rent=$a* $b;


        $totalBalance=$verifiedPaidAmount-$total_rent;


        return view('backend.tenant.room.rooms')->withTenant($tenant)->withBalance($totalBalance);
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
