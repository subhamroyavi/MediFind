<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Service;
use App\Models\Hospital;

class AdminDoctorController extends Controller
{
    public function index(Request $request)
    {
        // $doctors = Doctor::with(['services', 'hospitals', 'location', 'reviews.user'])->get();
        // $doctors = Doctor::all();
        // dd($doctors);
        $search = $request->search;
        if ($search) {
            $doctors = Doctor::where('first_name', 'like', "%$search%")
                ->orWhere('last_name', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%")
                ->orWhere('phone', 'like', "%$search%")
                ->orderBy('created_at', 'DESC')->paginate(5)->withQueryString();
        } else {
            $doctors = Doctor::orderBy('created_at', 'DESC')->paginate(5);
        }

        return view('admin_panel.doctors', compact('doctors', 'search'));

    }

    // public function create()
    // {
    //     $services = Service::all();
    //     // $hospitals = Hospital::all();
    //     return view('doctors.create', compact('services', 'hospitals'));
    // }

    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'first_name' => 'required|string|max:255',
    //         'last_name' => 'required|string|max:255',
    //         'specialization' => 'required|string',
    //         'phone' => 'required|string',
    //         'email' => 'required|email|unique:doctors,email',
    //         'experience_years' => 'nullable|integer',
    //         'home_town' => 'nullable|string',
    //         'organization_type' => 'nullable|string',
    //         'services' => 'nullable|array',
    //         'hospitals' => 'nullable|array'
    //     ]);

    //     $doctor = Doctor::create($validated);
        
    //     if ($request->has('services')) {
    //         $doctor->services()->sync($request->services);
    //     }
        
    //     if ($request->has('hospitals')) {
    //         $doctor->hospitals()->sync($request->hospitals);
    //     }

    //     return redirect()->route('doctors.show', $doctor)->with('success', 'Doctor created successfully');
    // }

    // public function show(Doctor $doctor)
    // {
    //     $doctor->load(['services', 'hospitals', 'location', 'reviews.user']);
    //     return view('doctors.show', compact('doctor'));
    // }

    // public function edit(Doctor $doctor)
    // {
    //     $services = Service::all();
    //     $hospitals = Hospital::all();
    //     return view('doctors.edit', compact('doctor', 'services', 'hospitals'));
    // }

    // public function update(Request $request, Doctor $doctor)
    // {
    //     $validated = $request->validate([
    //         'first_name' => 'sometimes|required|string|max:255',
    //         'last_name' => 'sometimes|required|string|max:255',
    //         'specialization' => 'sometimes|required|string',
    //         'phone' => 'sometimes|required|string',
    //         'email' => 'sometimes|required|email|unique:doctors,email,'.$doctor->doctor_id.',doctor_id',
    //         'experience_years' => 'nullable|integer',
    //         'home_town' => 'nullable|string',
    //         'organization_type' => 'nullable|string',
    //         'services' => 'nullable|array',
    //         'hospitals' => 'nullable|array'
    //     ]);

    //     $doctor->update($validated);
        
    //     if ($request->has('services')) {
    //         $doctor->services()->sync($request->services);
    //     }
        
    //     if ($request->has('hospitals')) {
    //         $doctor->hospitals()->sync($request->hospitals);
    //     }

    //     return redirect()->route('doctors.show', $doctor)->with('success', 'Doctor updated successfully');
    // }

    // public function destroy(Doctor $doctor)
    // {
    //     $doctor->delete();
    //     return redirect()->route('doctors.index')->with('success', 'Doctor deleted successfully');
    // }

    // public function addService(Request $request, Doctor $doctor)
    // {
    //     $request->validate([
    //         'service_id' => 'required|exists:medical_services,service_id',
    //         'status' => 'sometimes|string'
    //     ]);

    //     $doctor->services()->attach($request->service_id, ['status' => $request->status ?? 'active']);
    //     return back()->with('success', 'Service added successfully');
    // }

    // public function removeService(Doctor $doctor, Service $service)
    // {
    //     $doctor->services()->detach($service->service_id);
    //     return back()->with('success', 'Service removed successfully');
    // }

    // public function assignHospital(Request $request, Doctor $doctor)
    // {
    //     $request->validate([
    //         'hospital_id' => 'required|exists:hospitals,hospital_id',
    //         'status' => 'sometimes|string'
    //     ]);

    //     $doctor->hospitals()->attach($request->hospital_id, ['status' => $request->status ?? 'active']);
    //     return back()->with('success', 'Hospital assigned successfully');
    // }

    // public function unassignHospital(Doctor $doctor, Hospital $hospital)
    // {
    //     $doctor->hospitals()->detach($hospital->hospital_id);
    //     return back()->with('success', 'Hospital unassigned successfully');
    // }
}
