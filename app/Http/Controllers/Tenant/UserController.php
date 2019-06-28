<?php

namespace App\Http\Controllers\Tenant;

use App\Models\Building;
use App\Models\Damage;
use App\Models\RoomNumber;
use App\Models\Tenant;
use App\Models\Vacate;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function profileView()
    {
        return view('backend.tenant.profile')->withUser(Auth::user());
    }

    public function updateUserProfile(Request $request)
    {
        $this->validate($request,[
            'user_id'=>'required',
            'name'=>'required',
            'first_name'=>'required',
            'last_name'=>'required',
            'phone_number'=>'required|min:10|numeric',
//            'password'=>'required|confirmed'

        ]);

        $user=User::find($request->user_id);
        $user->name=$request->name;
        $user->first_name=$request->first_name;
        $user->last_name=$request->last_name;
        $user->phone_number=$request->phone_number;
//        $user->password=bcrypt($request->password);
        $user->save();


        return redirect()->back();
    }

    public function addRoom()
    {
        return view('backend.tenant.room.new_room');
    }

    public function buildingApartment($apartment)
    {
        $building=Building::where('apartment_id',$apartment)->get();

        return response()->json($building);
    }

    public function getRoomsBuilding($building)
    {
        $rooms=RoomNumber::where('building_id',$building)->where('is_vacant',false)->get();
        return response()->json([
            'rooms'=>$rooms
        ]);
    }

    public function saveTenantDetails(Request $request)
    {

        $this->validate($request,[
            'room_id'=>'required'
        ]);


        $room=RoomNumber::find($request->room_id);


        $tenant=new Tenant();
        $tenant->room_number_id=$request->room_id;
        $tenant->rent_balance=0;
        $tenant->current_deposit_amount=$room->pricing;
        $tenant->user_id=Auth::id();
        $tenant->is_active=true;
        $tenant->save();


        return redirect()->route('tenant.dashboard');

    }



}
