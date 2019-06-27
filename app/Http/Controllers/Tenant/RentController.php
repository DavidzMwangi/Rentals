<?php

namespace App\Http\Controllers\Tenant;

use App\Models\Rent;
use App\Models\Tenant;
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
}
