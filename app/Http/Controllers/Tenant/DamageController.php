<?php

namespace App\Http\Controllers\Tenant;

use App\Models\Apartment;
use App\Models\Building;
use App\Models\Damage;
use App\Models\RoomNumber;
use App\Models\Tenant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DamageController extends Controller
{
    public function __invoke()
    {
        $tenant=Tenant::where('user_id',Auth::id())->first();
        return view('backend.tenant.damage.damage')->withDamages(Damage::where('tenant_id',$tenant->id)->where('is_active',1)->with(['tenant','room'])->get());

    }




}
