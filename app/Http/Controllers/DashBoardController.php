<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashBoardController extends Controller
{
    public function adminDash()
    {
        return view('backend.admin.dashboard');
    }
}
