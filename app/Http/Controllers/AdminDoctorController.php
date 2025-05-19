<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Service;
use App\Models\Hospital;
use App\Models\Location;
use App\Models\Education;
use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminDoctorController extends Controller
{
    public function index(Request $request)
    {
        // $doctors = Doctor::with(['services', 'hospitals', 'location', 'reviews.user'])->get();
        // $service = Service::all();
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

    public function create()
    {
        // $services = Service::all();
        // $hospitals = Hospital::all();
        // return view('admin_panel.doctorsAction', compact('services', 'hospitals'));
        // return view('admin_panel.doctorsAction');
        $hospitals = Hospital::pluck('hospital_name', 'hospital_id');
        return view('admin_panel.doctors_action', compact('hospitals'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            // Basic Info
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|unique:doctors,email',
            'small_description' => 'required|string|max:255',

            // Professional Info
            'specialization' => 'required|string|max:255',
            'organization_type' => 'required|in:government,private,public',
            'status' => 'required|boolean',

            // Education (array validation)
            'educations' => 'required|array|min:1',
            'educations.*.course_name' => 'required|string|max:255',
            'educations.*.university' => 'required|string|max:255',
            'educations.*.date' => 'nullable|integer|size:4',
            'educations.*.country' => 'nullable|string|max:255',

            // Experience (array validation)
            'experiences' => 'required|array|min:1',
            'experiences.*.position' => 'required|string|max:255',
            'experiences.*.new_hospital_name' => 'nullable|string|max:255',
            'experiences.*.start_date' => 'nullable|integer|size:4',
            'experiences.*.end_date' => 'nullable|integer|size:4',
            'experiences.*.status' => 'required|boolean',

            // Location
            'address_line1' => 'required|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'pincode' => 'required|string|max:20',
            'country' => 'required|string|max:255',
            'google_maps_link' => 'nullable|url',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = 'doctor_' . time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('public/doctors', $filename);
            $validated['image'] = 'doctors/' . $filename; // Store relative path
        }

        try {
            // Create doctor record
            $doctor = Doctor::create([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'phone' => $validated['phone'],
                'email' => $validated['email'],
                'small_description' => $validated['small_description'],
                'specialization' => $validated['specialization'],
                'organization_type' => $validated['organization_type'],
                'status' => $validated['status'],
                'image' => $validated['image'],
            ]);

            // Create the associated location
            Location::create([
                'entity_type' => 'doctor',
                'entity_id' => $doctor->doctor_id,
                'address_line1' => $validated['address_line1'],
                'address_line2' => $validated['address_line2'],
                'city' => $validated['city'],
                'district' => $validated['district'],
                'state' => $validated['state'],
                'pincode' => $validated['pincode'],
                'country' => $validated['country'],
                'google_maps_link' => $validated['google_maps_link'] ?? null,
            ]);

            // Create multiple educations (assuming it's an array)
            $educationsData = collect($validated['educations'])->map(function ($education) use ($doctor) {
                return [
                    'entity_id' => $doctor->doctor_id,  // Make sure this matches your foreign key column name
                    'course_name' => $education['course_name'],
                    'university' => $education['university'],
                    'date' => $education['date'] ?? null,
                    'country' => $education['country'] ?? null,
                ];
            })->toArray();

            $doctor->education()->createMany($educationsData);

            // Create experience records - optimized
            // $experiencesData = array_map(function ($experience) use ($doctor) {
            //     return [
            //         'doctor_id' => $doctor->id,
            //         'position' => $experience['position'],
            //         'hospital_name' => $experience['new_hospital_name'] ?? null,
            //         'start_date' => $experience['start_date'] ?? null,
            //         'end_date' => $experience['end_date'] ?? null,
            //         'status' => $experience['status'],
            //     ];
            // }, $validated['experiences']);

            // $doctor->experiences()->createMany($experiencesData);

            DB::commit(); // Commit transaction if all operations succeed

            return redirect()->route('admin.doctors.index')
                ->with('success', 'Doctor created successfully!');
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback on error
            return back()->withInput()->with('error', 'Error creating doctor: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        // $services = Service::all();
        // $hospitals = Hospital::all();
        $doctor = Doctor::findOrFail($id);
        // return view('admin_panel.doctorsAction', compact('doctors'));
        return view('admin_panel.doctors_action', compact('doctor'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $validated = $request->validate([
            // Basic Info
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'phone' => 'required|string|max:20',
            'email' => 'required|email',
            'small_description' => 'required|string|max:255',

            // Professional Info
            'specialization' => 'required|string|max:255',
            'organization_type' => 'required|in:government,private,public',
            'status' => 'required|boolean',

            // Location
            'address_line1' => 'required|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'pincode' => 'required|string|max:20',
            'country' => 'required|string|max:255',
            'google_maps_link' => 'nullable|url',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = 'doctor_' . time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('public/doctors', $filename);
            $validated['image'] = 'doctors/' . $filename; // update relative path
        }

        try {
            // Update doctor record
            $doctor = Doctor::findOrFail($id)->update([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'phone' => $validated['phone'],
                'email' => $validated['email'],
                'small_description' => $validated['small_description'],
                'specialization' => $validated['specialization'],
                'organization_type' => $validated['organization_type'],
                'status' => $validated['status'],
                'image' => $validated['image'],
            ]);

            // dd($doctor);

            // Find related location
            $location = Location::where('entity_type', 'doctor')
                ->where('entity_id', $id)
                ->first();

            if ($location) {
                // Update the associated location
                $location->update([

                    'address_line1' => $validated['address_line1'],
                    'address_line2' => $validated['address_line2'],
                    'city' => $validated['city'],
                    'district' => $validated['district'],
                    'state' => $validated['state'],
                    'pincode' => $validated['pincode'],
                    'country' => $validated['country'],
                    'google_maps_link' => $validated['google_maps_link'] ?? null,
                ]);
            } else {
                // Handle case where location doesn't exist (maybe create new one?)
                Location::create([
                    'entity_type' => 'doctor',
                    'entity_id' => $doctor->doctor_id,
                    'address_line1' => $validated['address_line1'],
                    'address_line2' => $validated['address_line2'],
                    'city' => $validated['city'],
                    'district' => $validated['district'],
                    'state' => $validated['state'],
                    'pincode' => $validated['pincode'],
                    'country' => $validated['country'],
                    'google_maps_link' => $validated['google_maps_link'] ?? null,
                ]);
            }

            return redirect()->route('admin.doctors.index')
                ->with('success', 'Doctor Update successfully!');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Error creating doctor: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        Doctor::findOrFail($id)->delete($id);
        return redirect()->route('admin.doctors.index')->with('success', 'Doctor deleted successfully');
    }

    public function test()
    {

        // $doctors = Doctor::with(['services', 'hospitals', 'location', 'reviews.user'])->get();
        // $service = Service::all();
        // dd($doctors);

        $doctors = Doctor::with('location')->orderBy('created_at', 'DESC')->get();
        // dd($doctors);

        return view('admin_panel.doctors_test', compact('doctors'));
    }
}
