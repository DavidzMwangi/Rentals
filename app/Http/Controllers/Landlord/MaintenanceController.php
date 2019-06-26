<?php

namespace App\Http\Controllers\Landlord;

use App\Models\Apartment;
use App\Models\Building;
use App\Models\LandLord;
use App\Models\Maintenance;
use App\Models\RoomNumber;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MaintenanceController extends Controller
{
    public function newMaintenance()
    {

        //get the apartments where the landlord is the one
        $landlord=LandLord::where('user_id',Auth::id())->first();
        $apartments=Apartment::where('landlord_id',$landlord->id)->get();

        return view('backend.landlord.maintenance.new_maintenance')->withApartments($apartments);
    }

    public function saveNewMaintenance(Request $request)
    {
        $maintenasnce=new Maintenance();
        $maintenasnce->maintenance_date_time=$request->maintenance_date_time;
        $maintenasnce->description=$request->description;
        $maintenasnce->room_number_id=$request->room_number_id;
        $maintenasnce->save();
        
        
        
        return redirect()->route('landlord.all_maintenance');
    }

    public function allMaintenance()
    {

        //get the apartments where the landlord is the one
        $landlord=LandLord::where('user_id',Auth::id())->first();
        $apartments=Apartment::where('landlord_id',$landlord->id)->pluck('id');

        //get the buildings
        $building=Building::whereIn('apartment_id',$apartments)->pluck('id');

        //get the apartments
        $rooms=RoomNumber::whereIn('building_id',$building)->pluck('id');

        $maintenances=Maintenance::whereIn('room_number_id',$rooms)->orderBy('is_completed','DESC')->get();
        return view('backend.landlord.maintenance.all_maintenance')->withMaintenances($maintenances);
    }


    public function markMaintenanceComplete(Maintenance $maintenance)
    {
        $maintenance->is_completed=true;
        $maintenance->save();


        return redirect()->back();
    }
}
