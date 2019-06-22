<?php

namespace App\Http\Controllers\Tenant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function tenantDashBoard()
    {
        return view('backend.tenant.dashboard');
    }
}
