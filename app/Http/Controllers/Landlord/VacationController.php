<?php

namespace App\Http\Controllers\Landlord;

use App\Models\Apartment;
use App\Models\Building;
use App\Models\LandLord;
use App\Models\RoomNumber;
use App\Models\Vacate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class VacationController extends Controller
{
    public function __invoke()
    {

        //get the apartments where the landlord is the one
        $landlord=LandLord::where('user_id',Auth::id())->first();
        $apartments=Apartment::where('landlord_id',$landlord->id)->pluck('id');

        //get the buildings
        $building=Building::whereIn('apartment_id',$apartments)->pluck('id');

        //get the apartments
        $rooms=RoomNumber::whereIn('building_id',$building)->pluck('id');

        $vacations=Vacate::whereIn('room_number_id',$rooms)->get();
        return view('backend.landlord.vacate.vacate')->withVacations($vacations);

    }

    public function approveVacation(Vacate $vacation)
    {
        $vacation->is_active=false;
        $vacation->save();

        return redirect()->back();
    }
}
