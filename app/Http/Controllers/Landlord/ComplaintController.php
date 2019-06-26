<?php

namespace App\Http\Controllers\Landlord;

use App\Models\Apartment;
use App\Models\Building;
use App\Models\Complaint;
use App\Models\ComplaintResponse;
use App\Models\LandLord;
use App\Models\RoomNumber;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ComplaintController extends Controller
{
    public function __invoke()
    {

        //get the apartments where the landlord is the one
        $landlord=LandLord::where('user_id',Auth::id())->first();
        $apartments=Apartment::where('landlord_id',$landlord->id)->pluck('id');

        //get the buildings
        $building=Building::whereIn('apartment_id',$apartments)->pluck('id');

        //get the apartments
        $rooms=RoomNumber::whereIn('building_id',$building)->pluck('id');

        return view('backend.landlord.complaints.all_complaints')->withComplaints(Complaint::whereIn('room_number_id',$rooms)->get());
    }

    public function viewComplaintResponses(Complaint $complaint)
    {
        $responses=ComplaintResponse::where('complaint_id',$complaint->id)->get();


        return view('backend.landlord.complaints.complaint_responses')->withResponses($responses)->withComplaint($complaint);

    }


    public function saveNewComplaintResponse(Request $request)
    {
        $this->validate($request,[
            'complaint_id'=>'required',
            'message'=>'required'
        ]);

        //get the apartments where the landlord is the one
        $landlord=LandLord::where('user_id',Auth::id())->first();


            $response=new ComplaintResponse();
            $response->complaint_id=$request->complaint_id;
            $response->landlord_id=$landlord->id;
            $response->description=$request->message;
            $response->is_landlord=true;
            $response->save();



        return redirect()->back();

    }
}
