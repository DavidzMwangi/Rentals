<?php

namespace App\Http\Controllers;

use App\User;
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
            'email'=>'required',
            'phone_number'=>'required',
            'password'=>'required|confirmed'
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
}