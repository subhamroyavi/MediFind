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
use Illuminate\Support\Facades\Storage;

class AdminDoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::with(['locations', 'experiences', 'educations'])
            ->orderBy('created_at', 'DESC')
            ->get();
        // dd($doctors);

        return view('admin_panel.doctors', compact('doctors'));
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
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
            'educations.*.year' => 'required|string|size:4',
            'educations.*.country' => 'nullable|string|max:255',

            // Experience (array validation)
            'experiences' => 'required|array|min:1',
            'experiences.*.position' => 'required|string|max:255',
            'experiences.*.new_hospital_name' => 'required|string|max:255',
            'experiences.*.start_year' => 'required|string|size:4',
            'experiences.*.end_year' => 'required|string|size:4',
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

        // dd($validated['experiences']);

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = 'doctor_' . time() . '.' . $image->getClientOriginalName();
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

            $educationsData = collect($validated['educations'])->map(function ($education) use ($doctor) {
                return [
                    'doctor_id' => $doctor->doctor_id,
                    'course_name' => $education['course_name'],
                    'university' => $education['university'],
                    'date' => $education['year'] ?? null,
                    'country' => $education['country'] ?? null,
                ];
            })->toArray();
            // dd($educationsData);

            foreach ($educationsData as $education) {
                Education::create($education);
            }

            // if (!isset($doctor->educations)) {
            //     foreach ($validated['educations'] as $education) {
            //         Education::create([
            //             'doctor_id' => $doctor->id,
            //             'course_name' => $education['course_name'],
            //             'university' => $education['university'],
            //             'date' => $education['year'],
            //             'country' => $education['country'],
            //         ]);
            //     }
            // }

            // Create experience records - optimized
            $experiencesData = collect($validated['experiences'])->map(function ($experience) use ($doctor) {
                return [
                    'doctor_id' => $doctor->doctor_id,
                    'position' => $experience['position'],
                    'hospital_name' => $experience['new_hospital_name'] ?? null,
                    'start_date' => $experience['start_year'] ?? null,
                    'end_date' => $experience['end_year'] ?? null,
                    'status' => $experience['status'],
                ];
            })->toArray();

            foreach ($experiencesData as $experience) {
                Experience::create($experience);
            }




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

        $doctor = Doctor::with(['locations', 'experiences', 'educations'])->findOrFail($id);
        // dd($doctor);
        return view('admin_panel.doctors_action', compact('doctor'));
    }
    public function update(Request $request, $id)
    {
        //        foreach ($request->educations as $education) {
        //     dd(
        //         'Course: ' . $education['course_name'],
        //         'University: ' . $education['university'],
        //         'Year: ' . $education['year'],
        //         'Country: ' . $education['country'],
        //         'education_id: ' . $education['education_id']
        //     );
        // }

        $validated = $request->validate([
            // Basic Info
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'phone' => 'required|string|max:20',
            'email' => 'required|email',
            'small_description' => 'required|string|max:255',

            // Professional Info
            'specialization' => 'required|string|max:255',
            'organization_type' => 'required|in:government,private,public',
            'status' => 'required|boolean',

            // Education
            'educations' => 'required|array|min:1',
            'educations.*.education_id' => 'nullable|integer',
            'educations.*.course_name' => 'required|string|max:255',
            'educations.*.university' => 'required|string|max:255',
            'educations.*.year' => 'required|string|size:4',
            'educations.*.country' => 'required|string|max:255',

            // Experience
            'experiences' => 'required|array|min:1',
            'experiences.*.experience_id' => 'nullable|integer',

            'experiences.*.position' => 'required|string|max:255',
            'experiences.*.new_hospital_name' => 'required|string|max:255',
            'experiences.*.start_year' => 'required|string|size:4',
            'experiences.*.end_year' => 'required|string|size:4',
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
            $validated['image'] = 'doctors/' . $filename;
        }

        try {
            $doctor = Doctor::findOrFail($id);
            $doctor->update([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'phone' => $validated['phone'],
                'email' => $validated['email'],
                'small_description' => $validated['small_description'],
                'specialization' => $validated['specialization'],
                'organization_type' => $validated['organization_type'],
                'status' => $validated['status'],
                'image' => $validated['image'] ?? $doctor->image,
            ]);

            // Location update or create
            $location = Location::updateOrCreate(
                ['entity_type' => 'doctor', 'entity_id' => $id],
                [
                    'address_line1' => $validated['address_line1'],
                    'address_line2' => $validated['address_line2'],
                    'city' => $validated['city'],
                    'district' => $validated['district'],
                    'state' => $validated['state'],
                    'pincode' => $validated['pincode'],
                    'country' => $validated['country'],
                    'google_maps_link' => $validated['google_maps_link'] ?? null,
                ]
            );

            // Education update/create
            // if($validated['']){}
            foreach ($validated['educations'] as $education) {
                if (!empty($education['education_id'])) {
                    Education::where('education_id', $education['education_id'])->update([
                        'course_name' => $education['course_name'],
                        'university' => $education['university'],
                        'date' => $education['year'] ?? null,
                        'country' => $education['country'] ?? null,
                    ]);
                } else {
                    // Education::create([
                    //     'doctor_id' => $id,
                    //     'course_name' => $education['course_name'],
                    //     'university' => $education['university'],
                    //     'date' => $education['year'],
                    //     'country' => $education['country'],
                    // ]);
                    $educationsData = collect($validated['educations'])->map(function ($education) use ($doctor) {
                        return [
                            'doctor_id' => $doctor->doctor_id,
                            'course_name' => $education['course_name'],
                            'university' => $education['university'],
                            'date' => $education['year'] ?? null,
                            'country' => $education['country'] ?? null,
                        ];
                    })->toArray();
                    // dd($educationsData);

                    foreach ($educationsData as $education) {
                        Education::create($education);
                    }
                }
            }


            foreach ($validated['experiences'] as $experience) {
                if (!empty($experience['experience_id'])) {
                    Experience::where('experience_id', $experience['experience_id'])->update([
                        'position' => $experience['position'],
                        'hospital_name' => $experience['new_hospital_name'] ?? null,
                        'start_date' => $experience['start_year'] ?? null,
                        'end_date' => $experience['end_year'] ?? null,
                        'status' => $experience['status'],
                    ]);
                }
            }

            // (Optional) Experience update can be added here if needed.

            return redirect()->route('admin.doctors.index')
                ->with('success', 'Doctor updated successfully!');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Error updating doctor: ' . $e->getMessage());
        }
    }

    // public function update(Request $request, $id)
    // {
    //     // foreach ($request->educations as $education) {
    //     //     $educations = Education::findOrFail($education['education_id']);
    //     //     dd($educations);
    //     // }


    //     $validated = $request->validate([
    //         // Basic Info
    //         'first_name' => 'required|string|max:255',
    //         'last_name' => 'required|string|max:255',
    //         'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    //         'phone' => 'required|string|max:20',
    //         'email' => 'required|email',
    //         'small_description' => 'required|string|max:255',

    //         // Professional Info
    //         'specialization' => 'required|string|max:255',
    //         'organization_type' => 'required|in:government,private,public',
    //         'status' => 'required|boolean',

    //         // Education (array validation)
    //         'educations' => 'required|array|min:1',
    //         'educations.*.course_name' => 'required|string|max:255',
    //         'educations.*.university' => 'required|string|max:255',
    //         'educations.*.year' => 'nullable|string|size:4',
    //         'educations.*.country' => 'nullable|string|max:255',

    //         // Experience (array validation)
    //         'experiences' => 'required|array|min:1',
    //         'experiences.*.position' => 'required|string|max:255',
    //         'experiences.*.new_hospital_name' => 'nullable|string|max:255',
    //         'experiences.*.start_year' => 'nullable|string|size:4',
    //         'experiences.*.end_year' => 'nullable|string|size:4',
    //         'experiences.*.status' => 'required|boolean',

    //         // Location
    //         'address_line1' => 'required|string|max:255',
    //         'address_line2' => 'nullable|string|max:255',
    //         'city' => 'required|string|max:255',
    //         'district' => 'required|string|max:255',
    //         'state' => 'required|string|max:255',
    //         'pincode' => 'required|string|max:20',
    //         'country' => 'required|string|max:255',
    //         'google_maps_link' => 'nullable|url',
    //     ]);

    //     // Handle image upload
    //     if ($request->hasFile('image')) {
    //         $image = $request->file('image');
    //         $filename = 'doctor_' . time() . '.' . $image->getClientOriginalExtension();
    //         $path = $image->storeAs('public/doctors', $filename);
    //         $validated['image'] = 'doctors/' . $filename; // update relative path
    //     }

    //     try {
    //         // Update doctor record
    //         $doctor = Doctor::findOrFail($id)->update([
    //             'first_name' => $validated['first_name'],
    //             'last_name' => $validated['last_name'],
    //             'phone' => $validated['phone'],
    //             'email' => $validated['email'],
    //             'small_description' => $validated['small_description'],
    //             'specialization' => $validated['specialization'],
    //             'organization_type' => $validated['organization_type'],
    //             'status' => $validated['status'],
    //             'image' => $validated['image'],
    //         ]);

    //         // dd($doctor);

    //         // Find related location
    //         $location = Location::where('entity_type', 'doctor')
    //             ->where('entity_id', $id)
    //             ->first();

    //         if ($location) {
    //             // Update the associated location
    //             $location->update([

    //                 'address_line1' => $validated['address_line1'],
    //                 'address_line2' => $validated['address_line2'],
    //                 'city' => $validated['city'],
    //                 'district' => $validated['district'],
    //                 'state' => $validated['state'],
    //                 'pincode' => $validated['pincode'],
    //                 'country' => $validated['country'],
    //                 'google_maps_link' => $validated['google_maps_link'] ?? null,
    //             ]);
    //         } else {
    //             // Handle case where location doesn't exist (maybe create new one?)
    //             Location::create([
    //                 'entity_type' => 'doctor',
    //                 'entity_id' => $doctor->doctor_id,
    //                 'address_line1' => $validated['address_line1'],
    //                 'address_line2' => $validated['address_line2'],
    //                 'city' => $validated['city'],
    //                 'district' => $validated['district'],
    //                 'state' => $validated['state'],
    //                 'pincode' => $validated['pincode'],
    //                 'country' => $validated['country'],
    //                 'google_maps_link' => $validated['google_maps_link'] ?? null,
    //             ]);
    //         }

    //         $educationsData = collect($validated['educations'])->map(function ($education) use ($doctor) {
    //             return [
    //                 'education_id' => $education['education_id'] ?? null, // Make sure this matches your form field name
    //                 'doctor_id' => $doctor->doctor_id,
    //                 'course_name' => $education['course_name'],
    //                 'university' => $education['university'],
    //                 'date' => $education['year'] ?? null,
    //                 'country' => $education['country'] ?? null,
    //             ];
    //         })->toArray();

    //         dd($educationsData);

    //         foreach ($educationsData as $education) {
    //             if (!empty($education['education_id'])) {
    //                 // Update existing record
    //                 Education::where('education_id', $education['education_id'])
    //                     ->update([
    //                         'course_name' => $education['course_name'],
    //                         'university' => $education['university'],
    //                         'date' => $education['date'],
    //                         'country' => $education['country'],
    //                     ]);
    //             } else {
    //                 // Create new record
    //                 Education::create([
    //                     'doctor_id' => $id,
    //                     'course_name' => $education['course_name'],
    //                     'university' => $education['university'],
    //                     'date' => $education['date'],
    //                     'country' => $education['country'],
    //                 ]);
    //             }
    //         }

    //         return redirect()->route('admin.doctors.index')
    //             ->with('success', 'Doctor Update successfully!');
    //     } catch (\Exception $e) {
    //         return back()->withInput()->with('error', 'Error creating doctor: ' . $e->getMessage());
    //     }
    // }




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
