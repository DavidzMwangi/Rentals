<?php

namespace App\Http\Controllers;

use App\Models\RoomNumber;
use App\Models\Tenant;
use App\Models\Vacate;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function getAllUsers()
    {
        return view('backend.admin.user.all_users')->withUsers(User::all());
    }

    public function editUser(User $user)
    {
        Session::flash('_old_input',$user);

        return view('backend.admin.user.user');
    }

    public function addNewUser()
    {
        return view('backend.admin.user.user');

    }

    public function saveNewUser(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required|unique:users',
            'phone_number'=>'required|min:10|max:10',
            'password'=>'required|confirmed|min:8'
        ]);

        $user=User::find($request->user_id);
        if ($user==null){
            $user=new User();

        }

        $user->name=$request->name;
        $user->first_name=$request->first_name;
        $user->last_name=$request->last_name;
        $user->email=$request->email;
        $user->phone_number=$request->phone_number;
        $user->user_type=$request->user_type;
        $user->password=bcrypt($request->password);
        $user->save();


        return redirect()->back();
    }

    public function determineVacationContent()
    {
        $activeVacations=Vacate::where('is_active',true)->get();




        $today=Carbon::now();


        if ( $today->day==6){

            foreach ($activeVacations as $activeVacation){

                $room=RoomNumber::find($activeVacation->room_number_id);
                $room->is_vacant=true;
                $room->save();


                $tenant=Tenant::find($activeVacation->tenant_id);
                $tenant->is_active=false;
                $tenant->save();
            }


            Vacate::where('is_active',true)->update([
                'is_active'=>false
            ]);
        }


    }

    public function deleteUser(User $user)
    {
        $user->delete();
        return redirect()->back();
    }
}
