<?php

namespace App\Http\Controllers\Landlord;

use App\Models\Apartment;
use App\Models\Building;
use App\Models\LandLord;
use App\Models\RoomNumber;
use App\Models\Tenant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index()
    {
        //get the apartments where the landlord is the one
        $landlord=LandLord::where('user_id',Auth::id())->first();
        $apartments=Apartment::where('landlord_id',$landlord->id)->pluck('id');

        //get the buildings
        $building=Building::whereIn('apartment_id',$apartments)->pluck('id');

        //get the apartments
        $rooms=RoomNumber::whereIn('building_id',$building)->pluck('id');

        //get the tenants
        $tenants=Tenant::whereIn('room_number_id',$rooms)->where('is_active',true)->get();

        $unoccupiedRooms=RoomNumber::whereIn('building_id',$building)->where('is_vacant',true)->get();
        return view('backend.landlord.report.preview')->withTenants($tenants)->withApartments($apartments)->withBuildings($building)->withRooms($rooms)->withEmpty($unoccupiedRooms);
    }

    public function printReport()
    {
        //get the apartments where the landlord is the one
        $landlord=LandLord::where('user_id',Auth::id())->first();
        $apartments=Apartment::where('landlord_id',$landlord->id)->pluck('id');

        //get the buildings
        $building=Building::whereIn('apartment_id',$apartments)->pluck('id');

        //get the apartments
        $rooms=RoomNumber::whereIn('building_id',$building)->pluck('id');

        //get the tenants
        $tenants=Tenant::whereIn('room_number_id',$rooms)->where('is_active',true)->get();

        $unoccupiedRooms=RoomNumber::whereIn('building_id',$building)->where('is_vacant',true)->get();
        return view('backend.landlord.report.print_report')->withTenants($tenants)->withApartments($apartments)->withBuildings($building)->withRooms($rooms)->withEmpty($unoccupiedRooms);

    }
}
