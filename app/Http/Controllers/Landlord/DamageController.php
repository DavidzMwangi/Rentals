<?php

namespace App\Http\Controllers\Landlord;

use App\Models\Apartment;
use App\Models\Building;
use App\Models\Damage;
use App\Models\LandLord;
use App\Models\RoomNumber;
use App\Models\Tenant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DamageController extends Controller
{
    public function __invoke()
    {

        //get the apartments where the landlord is the one
        $landlord=LandLord::where('user_id',Auth::id())->first();
        $apartments=Apartment::where('landlord_id',$landlord->id)->get();
        return view('backend.landlord.damage.new')->withApartments($apartments)->withTenants(Tenant::all()->load('user'));
    }

    public function saveNewDamage(Request $request)
    {
        $this->validate($request,[
            'tenant_id'=>'required',
            'room_number_id'=>'required',
            'description'=>'required',
            'price'=>'required'

        ]);


        $damage=new Damage();
        $damage->tenant_id=$request->tenant_id;
        $damage->room_number_id=$request->room_number_id;
        $damage->description=$request->description;
        $damage->price=(Double)$request->price;
        $damage->is_active=true;
        $damage->save();


        return redirect()->back();
    }

    public function viewAllDamages()
    {
        //get the apartments where the landlord is the one
        $landlord=LandLord::where('user_id',Auth::id())->first();
        $apartments=Apartment::where('landlord_id',$landlord->id)->pluck('id');

        //get the buildings
        $building=Building::whereIn('apartment_id',$apartments)->pluck('id');

        //get the apartments
        $rooms=RoomNumber::whereIn('building_id',$building)->pluck('id');

        $damages=Damage::whereIn('room_number_id',$rooms)->where('is_active',true)->get();

        return view('backend.landlord.damage.all_damages')->withDamages($damages);
    }
}
