<?php

namespace App\Http\Controllers\Landlord;

use App\Models\Apartment;
use App\Models\Building;
use App\Models\LandLord;
use App\Models\RoomNumber;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    public function rooms()
    {
        $landlord=LandLord::where('user_id',Auth::id())->first();
        return view('backend.landlord.rooms.index')->withApartments(Apartment::where('landlord_id',$landlord->id)->get());
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

    public function saveNewRoom(Request $request)
    {
        $this->validate($request,[
            'building_id'=>'required',
            'name'=>'required',
            'pricing'=>'required',
            'room_type'=>'required',
        ]);

        $room=new RoomNumber();
        $room->name=$request->name;
        $room->building_id=$request->building_id;
        $room->pricing=$request->input('pricing');
        $room->is_vacant=true;
        $room->room_type=$request->room_type;
        $room->save();


        return redirect()->back();

    }
}
