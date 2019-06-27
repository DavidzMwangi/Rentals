<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Spatie\Permission\Models\Role;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/tenant/add_room';




    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone_number'=>['required'],
            'first_name'=>['required'],
            'last_name'=>['required'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        $user= User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'user_type'=>2,
            'is_verified'=>false,
            'first_name'=>$data['first_name'],
            'last_name'=>$data['last_name'],
            'phone_number'=>$data['phone_number']
        ]);



 $tenantRole=Role::where('name','Tenant')->first();
//        $officerRole=Role::where('name','Agricultural Officer')->first();
//        $farmerRole=Role::where('name','Farmer')->first();
//        if (request('user_type')==0) {
            $user->assignRole($tenantRole);
//        }else if (request('user_type')==1){
//            $user->assignRole($officerRole);
//        }else{
//            $user->assignRole($farmerRole);
//
//
//        }


        return  $user;
    }
}
