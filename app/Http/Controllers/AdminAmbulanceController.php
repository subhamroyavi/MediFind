<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Ambulance;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class AdminAmbulanceController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        if ($search) {
            $ambulances = Ambulance::with('location')
                ->when($search, function ($query) use ($search) {
                    $query->where(function ($q) use ($search) {
                        $q->where('first_name', 'like', "%$search%")
                            ->orWhere('last_name', 'like', "%$search%")
                            ->orWhere('email', 'like', "%$search%")
                            ->orWhere('phone', 'like', "%$search%")
                            ->orWhereHas('location', function ($q) use ($search) {
                                $q->where('city', 'like', "%$search%");
                            });
                    });
                })
                ->orderBy('created_at', 'DESC')
                ->paginate(5)
                ->withQueryString();
        } else {
            // $ambulances = Ambulance::with('location')->orderBy('created_at', 'DESC')->paginate(5);
            $ambulances = Ambulance::with(['location'])->orderBy('created_at', 'DESC')->get();
        }
        return view('admin_panel.ambulance', compact('ambulances'));
    }

    public function create()
    {
        // return view('admin_panel.ambulaceAction');
        return view('admin_panel.ambulance_action');
    }

    public function store(Request $request)
    {
        // dd($request->file('image'));
        // Validate ambulance details
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:ambulances,email',
            'phone' => 'required|string|max:20',
            'license_number' => 'required|string|max:50',
            'vehicle_number' => 'required|string|max:20|unique:ambulances,vehicle_number',
            'vehicle_model' => 'required|string|max:100',
            'organization_type' => 'required',
            'service_type' => 'required',
            'insurance_number' => 'required|string|max:50',
            'status' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',



        ]);

        // Validate location/address details
        $validated1 = $request->validate([
            'address_line1' => 'required|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'district' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'pincode' => 'required|string|max:10',
            'country' => 'required|string|max:100',
            'google_maps_link' => 'required',
        ]);

        // Handle image upload if present
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = 'ambulance_' . time() . '_' . $image->getClientOriginalName();
            $path = $image->storeAs('public/ambulances', $filename);
            $validated['image'] = 'ambulances/' . $filename;
        }

        // Create the ambulance

        try {
            $ambulance = Ambulance::create($validated);
            // dd($ambulance);
            // Create the associated location
            Location::create(array_merge(
                $validated1,
                [
                    'entity_type' => 'ambulance',
                    'entity_id' => $ambulance->ambulance_id,
                ]
            ));
        } catch (\Exception $e) {
            // dd($e->getMessage());
            $e->getMessage();
        }


        return redirect()->route('admin.ambulance.index')
            ->with('success', 'Ambulance created successfully!');
    }
    public function view($id)
    {
        $ambulance = Ambulance::findOrFail($id);
        return view('admin_panel.ambulance_action', compact('ambulance'));
    }

    public function edit($id)
    {
        $ambulance = Ambulance::with(['location'])->findOrFail($id);
        // dd($ambulance->toArray());
        return view('admin_panel.ambulance_action', compact('ambulance'));
    }

    public function update(Request $request, $id)
    {
        // Validate ambulance details
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'license_number' => 'required|string|max:50',
            'vehicle_number' => 'required|string|max:20',
            'vehicle_model' => 'required|string|max:100',
            'organization_type' => 'required',
            'service_type' => 'required',
            'insurance_number' => 'required|string|max:50',
            'status' => 'required|boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

            // Validate location/address details
            'address_line1' => 'required|string|max:255',
            'address_line2' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'district' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'pincode' => 'required|string|max:10',
            'country' => 'required|string|max:100',
            'google_maps_link' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $ambulance = Ambulance::findOrFail($id);

            // Handle image upload
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($ambulance->image) {
                    Storage::delete('public/' . $ambulance->image);
                }

                $image = $request->file('image');
                $filename = 'ambulance_' . time() . '_' . $image->getClientOriginalName();
                $path = $image->storeAs('public/ambulances', $filename);
                $validated['image'] = 'ambulances/' . $filename;
            } else {
                // Keep the existing image if no new image is uploaded
                $validated['image'] = $ambulance->image;
            }

            // Update ambulance details
            $ambulance->update($validated);

            // Update or create location using updateOrCreate for cleaner code
            Location::updateOrCreate(
                [
                    'entity_type' => 'ambulance',
                    'entity_id' => $ambulance->ambulance_id,
                ],
                [
                    'address_line1' => $validated['address_line1'],
                    'address_line2' => $validated['address_line2'],
                    'city' => $validated['city'],
                    'district' => $validated['district'],
                    'state' => $validated['state'],
                    'pincode' => $validated['pincode'],
                    'country' => $validated['country'],
                    'google_maps_link' => $validated['google_maps_link'],
                ]
            );

            DB::commit();

            return redirect()->route('admin.ambulance.index')
                ->with('success', 'Ambulance updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Failed to update ambulance: ' . $e->getMessage()])
                ->withInput();
        }
    }
    public function destroy($id)
    {
        // Ambulance::findOrFail($id)->delete($id);
        $ambulance = Ambulance::findOrFail($id);
        $ambulance->delete();

        // Find related location
        $location = Location::where('entity_type', 'ambulance')
            ->where('entity_id', $ambulance->ambulance_id)
            ->first();

        if ($location) {
            $location->delete();
        }
        return redirect()->route('admin.ambulance.index')->with('success', 'Ambulance updated successfully');
    }
}
