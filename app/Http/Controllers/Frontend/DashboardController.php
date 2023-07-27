<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(){
        $user = auth()->user();
        return view('frontend.dashboard.dashboard',compact('user'));
    }

    public function settings(){
        return view('frontend.dashboard.settings');
    }
}
