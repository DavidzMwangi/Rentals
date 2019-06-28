<?php

namespace App\Http\Controllers\Tenant;

use App\Models\Rent;
use App\Models\Tenant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function tenantDashBoard()
    {
        //get tenants transactions
        $tentant=Tenant::where('user_id',Auth::id())->first();


        $rents=Rent::where('tenant_id',$tentant->id)->get();
        return view('backend.tenant.dashboard')->withRents($rents);
    }
}
