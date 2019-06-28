<?php

namespace App\Http\Controllers\Landlord;

use App\Models\Apartment;
use App\Models\Building;
use App\Models\LandLord;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BuildingController extends Controller
{
    public function building()
    {

        $landlord=LandLord::where('user_id',Auth::id())->first();
        return view('backend.landlord.buildings.index')->withApartments(Apartment::where('landlord_id',$landlord->id)->get());
    }


    public function getApartmentBuildings($apartment_id)
    {
        $buildings=Building::where('apartment_id',$apartment_id)->get()->load('apartment');

        return response()->json([
            'buildings'=>$buildings
        ]);
    }

    public function saveNewBuilding(Request $request)
    {
        $this->validate($request,[

            'name'=>'required',
            'description'=>'required',
            'apartment_id'=>'required',
        ]);
        $building=new Building();
        $building->name=$request->name;
        $building->description=$request->description;
        $building->apartment_id=$request->apartment_id;
        $building->save();


        return redirect()->back();
    }

    public function deleteBuilding(Building $building)
    {
        $building->delete();


        return response()->json();
    }
}
