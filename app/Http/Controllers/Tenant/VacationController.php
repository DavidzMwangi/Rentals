<?php

namespace App\Http\Controllers\Tenant;

use App\Models\Damage;
use App\Models\RoomNumber;
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


    public function approveVacation(Vacate $vacation)
    {

        $tenant=Tenant::where('user_id',Auth::id())->first();

        $damages=Damage::where("tenant_id",$tenant->id)->where('is_active',true)->sum('price');


       $rem= $tenant->current_deposit_amount-$damages;


       if ($rem>0){



           Damage::where("tenant_id",$tenant->id)->where('is_active',true)->update([
               'is_active'=>false
           ]);



//           $room=RoomNumber::find($tenant->room_number_id);
//            $room->is_vacant=true;
//            $room->save();

           return response()->json([
               'rer'=>'success',
               'status'=>1
           ]);

       }else{
           return response()->json([
               'rer'=>'You damages charge exceeds your deposit. Pay first',
               'status'=>2
           ]);
       }
    }
}
