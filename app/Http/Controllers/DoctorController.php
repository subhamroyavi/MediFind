<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Education;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        if ($search) {

            $doctors = Doctor::with(['locations', 'experiences', 'educations'])
                ->where(function ($query) use ($search) {
                    $query->where('first_name', 'like', "%$search%")
                        ->orWhere('last_name', 'like', "%$search%")
                        ->orWhere('specialization', 'like', "%$search%")
                        ->orWhere('phone', 'like', "%$search%")
                        ->orWhere('email', 'like', "%$search%")
                        ->orWhere('organization_type', 'like', "%$search%")
                        ->orWhereHas('locations', function ($q) use ($search) {
                            $q->where('address_line1', 'like', "%$search%")
                                ->orWhere('address_line2', 'like', "%$search%")
                                ->orWhere('city', 'like', "%$search%")
                                ->orWhere('district', 'like', "%$search%")
                                ->orWhere('state', 'like', "%$search%")
                                ->orWhere('pincode', 'like', "%$search%")
                                ->orWhere('country', 'like', "%$search%");
                        });
                })
                ->orderBy('created_at', 'DESC')
                ->paginate(9)
                ->withQueryString();
        } else {
            $doctors = Doctor::with(['locations', 'experiences', 'educations'])
                ->orderBy('created_at', 'DESC')
                ->paginate(9);
            // dd($doctorData->toArray());

        }

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
