<?php

namespace App\Http\Controllers\Tenant;

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
            'phone_number'=>'required',
            'password'=>'required|confirmed'

        ]);

        $user=User::find($request->user_id);
        $user->name=$request->name;
        $user->first_name=$request->first_name;
        $user->last_name=$request->last_name;
        $user->phone_number=$request->phone_number;
        $user->password=bcrypt($request->password);
        $user->save();


        return redirect()->back();
    }
}
