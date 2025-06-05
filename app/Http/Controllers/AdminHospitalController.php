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
    public function index()
    {
        $hospitals = Hospital::with(['contacts', 'facilities', 'services', 'openingDays', 'location'])
            ->orderBy('created_at', 'DESC')
            ->get();
        //    dd($hospitals->first()->services);
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
            'website_link' => 'nullable|url',

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
        // Validate input
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
            'website_link' => 'nullable|url',


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

        // dd($validated);
        DB::beginTransaction();

        try {
            $hospital = Hospital::findOrFail($id);

            // Handle image
            if ($request->hasFile('image')) {
                // Delete old image
                if ($hospital->image) {
                    Storage::disk('public')->delete($hospital->image);
                }

                $image = $request->file('image');
                $filename = 'hospitals_' . time() . '_' . $image->getClientOriginalName();
                $image->storeAs('public/hospitals', $filename);
                $validated['image'] = 'hospitals/' . $filename;
            }

            $validated['status'] = $validated['status'] ?? 0;

            // Update hospital
            $hospital->update([
                'hospital_name' => $validated['hospital_name'],
                'description' => $validated['description'],
                'organization_type' => $validated['organization_type'],
                'status' => $validated['status'],
                'image' => $validated['image'] ?? $hospital->image,
            ]);

            // Sync Opening Days
            $hospital->openingDays()->delete();
            foreach ($validated['opening_days'] as $dayData) {
                $hospital->openingDays()->create([
                    'opening_day' => $dayData['day'],
                    'opening_time' => $dayData['opening_time'],
                    'closing_time' => $dayData['closing_time'],
                    'status' => isset($dayData['status']) ? 1 : 0,
                ]);
            }

            // Sync Contacts
            $hospital->contacts()->delete();
            foreach ($validated['contacts'] as $contactData) {
                $hospital->contacts()->create([
                    'contact_type' => $contactData['contact_type'],
                    'value' => $contactData['value'],
                    'is_primary' => isset($contactData['is_primary']) ? 1 : 0,
                    'website_link' => $validated['website_link'],
                ]);
            }

            // Sync Services
            $hospital->services()->delete();
            foreach ($validated['services'] as $serviceData) {
                $hospital->services()->create([
                    'service_name' => $serviceData['service_name'],
                ]);
            }

            // Sync Facilities
            $hospital->facilities()->delete();
            foreach ($validated['facilities'] as $facilityData) {
                $hospital->facilities()->create([
                    'description' => $facilityData['description'],
                ]);
            }

            // Update location
            $location = $hospital->location ?? new Location();
            $location->fill([
                'entity_type' => 'hospital',
                'entity_id' => $hospital->hospital_id,
                'address_line1' => $validated['address_line1'],
                'address_line2' => $validated['address_line2'],
                'city' => $validated['city'],
                'district' => $validated['district'],
                'state' => $validated['state'],
                'pincode' => $validated['pincode'],
                'country' => $validated['country'],
                'google_maps_link' => $validated['google_maps_link'],
            ])->save();

            DB::commit();

            return redirect()->route('admin.hospital')
                ->with('success', 'Hospital updated successfully.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Error updating hospital: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $hospital = Hospital::findOrFail($id);

            // Delete hospital image if it exists
            if ($hospital->image && Storage::disk('public')->exists($hospital->image)) {
                Storage::disk('public')->delete($hospital->image);
            }

            // Delete related models
            $hospital->facilities()->delete();
            $hospital->contacts()->delete();
            $hospital->services()->delete();
            $hospital->openingDays()->delete();

            // Delete location if exists
            if ($hospital->location) {
                $hospital->location->delete();
            }

            // Finally, delete the hospital
            $hospital->delete();

            DB::commit();

            return redirect()->route('admin.hospital')
                ->with('success', 'Hospital deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Error deleting hospital: ' . $e->getMessage());
        }
    }
}
