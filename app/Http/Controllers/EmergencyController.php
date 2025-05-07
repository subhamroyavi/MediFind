<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmergencyController extends Controller
{
    public function emergency_index(){
        return view('user_panel.emergency');
    }
}
