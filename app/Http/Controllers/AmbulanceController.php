<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AmbulanceController extends Controller
{
    public function index(){
        return view('user_panel.ambulances');
    }
}
