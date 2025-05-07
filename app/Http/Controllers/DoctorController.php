<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index(){
        return view('user_panel.doctors');
    }

    public function doctor_details(){
        return view('user_panel.doctor-details');
    }
}
