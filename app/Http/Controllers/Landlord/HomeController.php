<?php

namespace App\Http\Controllers\Landlord;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function landlordDashboard()
    {
        return view('backend.landlord.dashboard');
    }
}
