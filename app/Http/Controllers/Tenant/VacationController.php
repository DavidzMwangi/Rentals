<?php

namespace App\Http\Controllers\Tenant;

use App\Models\Tenant;
use App\Models\Vacate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class VacationController extends Controller
{
    public function __invoke()
    {

        $tenant=Tenant::where('user_id',Auth::id())->first();
        return view('backend.tenant.vacate.vacate')->withVacation(Vacate::where('is_active',true)->where('tenant_id',$tenant->id)->first());
    }


    public function saveNewVacation(Request $request)
    {

        $tenant=Tenant::where('user_id',Auth::id())->first();
        $vacation=new Vacate();
        $vacation->vacate_date=$request->vacate_date;
        $vacation->tenant_id=$tenant->id;
        $vacation->room_number_id=$tenant->room_number_id;
        $vacation->save();


        return redirect()->back();

    }
}
