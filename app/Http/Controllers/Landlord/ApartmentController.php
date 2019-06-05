<?php

namespace App\Http\Controllers\Landlord;

use App\Models\Apartment;
use App\Models\LandLord;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ApartmentController extends Controller
{
    public function __invoke()
    {
        $landlord=LandLord::where('user_id',Auth::id())->first();

        return view('backend.landlord.apartments.index')->withApartments(Apartment::where('landlord_id',$landlord->id)->with(['landlord','location'])->get());
    }

    public function newAppartmentView()
    {
        return view('backend.landlord.apartments.new');
    }

    public function saveNewApartment(Request $request)
    {
        $this->validate($request,[
            'apartment_name'=>'required',
            'description'=>'required',

        ]);

        $landlord=LandLord::where('user_id',Auth::id())->first();

//        return json_encode($landlord);
        $apart=new Apartment();
        $apart->apartment_name=$request->apartment_name;
        $apart->description=$request->description;
        $apart->landlord_id=$landlord->id;
        $apart->location_id=$request->location_id;
        $apart->save();


        return redirect()->route('landlord.apartments');
    }
}
