<?php

namespace App\Http\Controllers\Landlord;

use App\Models\Apartment;
use App\Models\LandLord;
use App\Models\Rent;
use App\Models\RoomNumber;
use App\Models\Tenant;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TenantController extends Controller
{
    public function tenants()
    {
        $landlord=LandLord::where('user_id',Auth::id())->first();
        return view('backend.landlord.tenants.index')->withApartments(Apartment::where('landlord_id',$landlord->id)->get());
    }

    public function getOccupiedRooms($building_id)
    {
        //            'rooms'=>RoomNumber::where('building_id',$building_id)->get()->load('building'),
        $rooms=RoomNumber::where(['building_id'=>$building_id,'is_vacant'=>false])->pluck('id');

        $tenants=Tenant::whereIn('room_number_id',$rooms)->get()->load(['user','room']);

// $paymentOrders=array();
//
//        foreach ($salePaymentOrders as $key=>$singleOrder){
//            $bus=json_decode($singleOrder->payment_records_ids);
//            $paymentOrders[]=$singleOrder;
//            $paymentOrders[$key]['records']=$bus;
//
//
//            //clear the array for it to store the next set of loop
//            unset($bus);
//        }

        $new_tenants=array();

        foreach ($tenants as $tenant){


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



            $tenant->balanced=$totalBalance;


        }
        return response()->json([
            'tenants'=>$tenants
        ]);
    }
}
