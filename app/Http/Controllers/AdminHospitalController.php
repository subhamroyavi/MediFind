<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Service;
use App\Models\Facility;
use App\Models\Hospital;
use App\Models\Location;
use App\Models\OpeningDay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminHospitalController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        if ($search) {
            $hospitals = Hospital::where('hospital_name', 'like', "%$search%")
                ->orWhere('organization_type', 'like', "%$search%")
                ->orderBy('created_at', 'DESC')->paginate(5)->withQueryString();
        } else {
            $hospitals = Hospital::orderBy('created_at', 'DESC')->paginate(5);
        }
        return view('admin_panel.hospitals', compact('hospitals'));
    }

    public function create()
    {
        // return view('admin_panel.hospitalAction');
        return view('admin_panel.hospital_action');
    }

    public function store(Request $request)
    {

        // dd($request->toArray());
        // Validate the main hospital data
        $validated = $request->validate([
            'hospital_name' => 'required|string|max:255',
            'organization_type' => 'required|string|max:255',
            'description' => 'required|string',
            'website_link' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'sometimes|boolean',

            // Facilities
            'facilities' => 'required|array|min:1',
            'facilities.*.description' => 'required|string|max:255',

            // Contacts
            'contacts' => 'required|array|min:1',
            'contacts.*.contact_type' => 'required|string|in:phone,email,fax,other',
            'contacts.*.value' => 'required|string|max:255',
            'contacts.*.is_primary' => 'sometimes|boolean',

            // Services
            'services' => 'required|array|min:1',
            'services.*.service_name' => 'required|string|max:255',

            // Opening days
            'opening_days' => 'required|array|min:1',
            'opening_days.*.day' => 'required|string|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'opening_days.*.opening_time' => 'required|date_format:H:i',
            'opening_days.*.closing_time' => 'required|date_format:H:i|after:opening_days.*.opening_time',
            'opening_days.*.status' => 'sometimes|boolean',

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


        // dd($validated['opening_days']);

        DB::beginTransaction();

        try {

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $filename = 'hospitals_' . time() . '_' . $image->getClientOriginalName();
                $path = $image->storeAs('public/hospitals', $filename);
                $validated['image'] = 'hospitals/' . $filename;
            } else {
                $validated['image'] = null;
            }

            // Ensure status is always set (checkbox fallback)
            $validated['status'] = $validated['status'] ?? 0;

            // Create the hospital
            $hospital = Hospital::create([
                'hospital_name' => $validated['hospital_name'],
                'description' => $validated['description'],
                'organization_type' => $validated['organization_type'],
                'status' => $validated['status'],
                'image' => $validated['image'],
            ]);

            // Save opening days
            if ($request->has('opening_days')) {
                foreach ($validated['opening_days'] as $dayData) {
                    $openingDay = new OpeningDay([
                        'hospital_id' => $hospital->hospital_id,
                        'opening_day' => $dayData['day'],
                        'opening_time' => $dayData['opening_time'],
                        'closing_time' => $dayData['closing_time'],
                        'status' => isset($dayData['status']) ? 1 : 0,
                    ]);
                    $openingDay->save();
                }
            }
  
            // Save contacts
            if ($request->has('contacts')) {
                foreach ($validated['contacts'] as $contactData) {
                    $contact = new Contact([
                        'hospital_id' => $hospital->hospital_id,
                        'contact_type' => $contactData['contact_type'],
                        'value' => $contactData['value'],
                        'is_primary' => isset($contactData['is_primary']) ? 1 : 0,
                        'website_link' => $validated['website_link'],
                    ]);
                    $contact->save();
                }
            }

            // Save services
            if ($request->has('services')) {
                foreach ($validated['services'] as $serviceData) {
                    $service = new Service([
                        'hospital_id' => $hospital->hospital_id,
                        'service_name' => $serviceData['service_name'],
                    ]);
                    $service->save();
                }
            }


            // Save facilities
            if ($request->has('facilities')) {
                foreach ($validated['facilities'] as $facilityData) {
                    $facility = new Facility([
                        'hospital_id' => $hospital->hospital_id,
                        'description' => $facilityData['description'],
                    ]);
                    $facility->save();
                }
            }

            // Save location
            $location = new Location([
                'entity_type' => 'hospital',
                'entity_id' => $hospital->hospital_id,
                'address_line1' => $request->address_line1,
                'address_line2' => $request->address_line2,
                'city' => $request->city,
                'district' => $request->district,
                'state' => $request->state,
                'pincode' => $request->pincode,
                'country' => $request->country,
                'google_maps_link' => $request->google_maps_link,
            ]);
            $location->save();

            DB::commit();

            return redirect()->route('admin.hospital')
                ->with('success', 'Hospital created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            // Delete the uploaded image if something went wrong
            if (isset($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }

            return back()->withInput()
                ->with('error', 'Error creating hospital: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {

        $hospital = Hospital::with(['facilities', 'services', 'openingDays', 'location'])->findOrFail($id);
        // dd($hospital);
        //  return view('admin_panel.hospitalAction', compact('hospital'));
        return view('admin_panel.hospital_action', compact('hospital'));
    }

    public function update(Request $request, $id)
    {
        //  dd($request->all());
        $validated = $request->validate([
            'hospital_name' => 'required|string|max:255',
            'description' => 'required|string',

            'organization_type' => 'required|in:government,private,public',
            'status' => 'required|boolean',
            'image' => 'required|mimes:jpeg,png,jpg|max:2048'
        ]);



        // Process file upload
        if (!$request->hasFile('image')) {
            dd('No file uploaded!', $request->all());
        } else {

            $image = $request->file('image');
            $filename = 'Hospital_' . time() . '_' . $image->getClientOriginalName();
            $path = $image->storeAs('public/Hospitals', $filename);
            $validated['image'] = 'Hospitals/' . $filename;
        }

        Hospital::findOrFail($id)->update($validated);

        return redirect()->route('admin.hospitals')
            ->with('success', 'Hospital created successfully!');
    }

    public function destroy($id)
    {
        Hospital::findOrFail($id)->delete();

        return redirect()->route('admin.hospitals')
            ->with('success', 'Hospital created successfully!');
    }
}
