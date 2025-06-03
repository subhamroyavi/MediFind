<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    public function index(){
      $hospitals = Hospital::with(['contacts', 'facilities', 'services', 'openingDays', 'location'])
      ->where('status', '1')
    ->orderBy('created_at', 'DESC')
    ->paginate(6);

        return view('user_panel.hospitals', compact('hospitals'));
    }

    public function hospital_details($id){
         $hospital = Hospital::with(['facilities', 'services', 'openingDays', 'location'])->findOrFail($id);
        return view('user_panel.hospital-details', compact('hospital'));
    }
}
