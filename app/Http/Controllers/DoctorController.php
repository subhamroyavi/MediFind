<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Education;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {

        $doctors = Doctor::with(['locations', 'experiences', 'educations'])
            ->orderBy('created_at', 'DESC')
            ->paginate(6);
        // dd($doctorData->toArray());

        return view('user_panel.doctors', compact('doctors'));
    }

    public function doctor_details($id)
    {
        $doctorData = Doctor::with(['locations', 'experiences', 'educations'])
            ->findOrFail($id);
        // dd($doctorData->toArray());

        return view('user_panel.doctor-details', compact('doctorData'));
    }
}
