<?php

namespace App\Http\Controllers\Tenant;

use App\Models\Complaint;
use App\Models\ComplaintResponse;
use App\Models\RoomNumber;
use App\Models\Tenant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ComplaintController extends Controller
{
    public function newComplaint()
    {
        return view('backend.tenant.complaints.new');
    }

    public function saveNewComplaint(Request $request)
    {
        $tenant=Tenant::where('is_active',true)->where('user_id',Auth::id())->first();

        $complaint=new Complaint();
        $complaint->description=$request->description;
        $complaint->tenant_id=$tenant->id;
        $complaint->room_number_id=$tenant->room_number_id;
        $complaint->save();


        return redirect()->route('tenant.complaint.all_complaints');
    }

    public function allComplaints()
    {
        $tenant=Tenant::where('is_active',true)->where('user_id',Auth::id())->first();

        return view('backend.tenant.complaints.view_complaints')->withComplaints(Complaint::where('tenant_id',$tenant->id)->latest()->get());
    }

    public function deleteComplaint(Complaint $complaint)
    {
        try{
            $complaint->delete();
        }catch (\Exception $e){

        }

        return redirect()->route('tenant.complaint.all_complaints');

    }

    public function viewComplaintsResponses(Complaint $complaint)
    {
        $responses=ComplaintResponse::where('complaint_id',$complaint->id)->get();


        return view('backend.tenant.complaints.complaint_responses')->withResponses($responses)->withComplaint($complaint);

    }

    public function saveNewComplaintResponse(Request $request)
    {
        $this->validate($request,[
            'complaint_id'=>'required',
            'message'=>'required'
        ]);


        $existingResponse=ComplaintResponse::where('complaint_id',$request->complaint_id)->first();
        if($existingResponse!=now()){

            $response=new ComplaintResponse();
            $response->complaint_id=$request->complaint_id;
            $response->landlord_id=$existingResponse->landlord_id;
            $response->description=$request->message;
            $response->is_landlord=false;
            $response->save();
        }


        return redirect()->back();

    }
}
