<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HospitalController extends Controller
{
    public function index(){
        return view('user_panel.hospitals');
    }

    public function hospital_details(){
        return view('user_panel.hospital-details');
    }
}
