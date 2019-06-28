<?php

namespace App\Http\Controllers\Tenant;

use App\Models\Rent;
use App\Models\RoomNumber;
use App\Models\Tenant;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RentController extends Controller
{
    public function __invoke()
    {
        $tenant=Tenant::where('user_id',Auth::id())->where('is_active',true)->first();

        $rents=Rent::where('tenant_id',$tenant->id)->get();
        return view('backend.tenant.rent.new')->withRents($rents);
    }

    public function saveNewRent(Request $request)
    {
        $tenant=Tenant::where('user_id',Auth::id())->where('is_active',true)->first();

        $rent=new Rent();
        $rent->amount=$request->amount;
        $rent->month=$request->month;
        $rent->year=$request->year;
        $rent->confirmation_code=$request->confirmation_code;
        $rent->tenant_id=$tenant->id;
        $rent->save();


        return redirect()->back();
    }


    public function rentBalance(){
        $tenant=Tenant::where('user_id',Auth::id())->first();

        //query the amount paid that is confirmed
        $verifiedPaidAmount=Rent::where('tenant_id',$tenant->id)->where('is_verified',true)->sum('amount');


        //get the months the user has been in the room
        $months=Carbon::now()->diffInMonths($tenant->created_at);


        //get the amount of the room
        $room=RoomNumber::find($tenant->room_number_id);



        $a=$room->pricing;
        $b=$months==0?1:$months;

        $total_rent=$a* $b;


        $totalBalance=$verifiedPaidAmount-$total_rent;


        return $totalBalance;

    }
}
