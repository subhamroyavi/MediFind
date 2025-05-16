<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ambulance;
use App\Models\Location;

class AdminAmbulanceController extends Controller
{
    public function index(Request $request)
    {

        $search = $request->search;
        if ($search) {
            $ambulances = Ambulance::where('first_name', 'like', "%$search%")
                ->orWhere('last_name', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%")
                ->orWhere('phone', 'like', "%$search%")
                ->orderBy('created_at', 'DESC')->paginate(5)->withQueryString();
        } else {
            $ambulances = Ambulance::orderBy('created_at', 'DESC')->paginate(5);
        }
        return view('admin_panel.ambulance', compact('ambulances'));
    }

    public function create()
    {
        return view('admin_panel.ambulaceAction');
    }

    public function store(Request $request) {

        // dd($request->file('image'));
        $validated = $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'phone' => 'required|string',
        'email' => 'required|email|unique:ambulances,email',
        'vehicle_number' => 'required',
        'service_type' => 'required|in:BLS,ALS,ICU,other',
        'organization_type' => 'required|in:government,private,public',
        'status' => 'required|boolean',
        'image' => 'required|mimes:jpeg,png,jpg|max:2048'
    ]);

    // Process file upload
     if (!$request->hasFile('image')) {
        dd('No file uploaded!', $request->all());
    } else {

        $image = $request->file('image');
        $filename = 'ambulance_' . time() . '_' . $image->getClientOriginalName();
        $path = $image->storeAs('public/ambulances', $filename);
        $validated['image'] = 'ambulances/' . $filename;
    }

    $id = Ambulance::create($validated);
    // dd($id->ambulance_id);

    Location::create([
        'entity_type' => 'ambulance',
            'entity_id' => $id->ambulance_id,
            'address_line1' => 'Shitala Bari Road',
            'address_line2'=> 'Shitala Bari Road',
            'city' => 'Dinhata',
            'district' => 'Cooch Behar',
            'pincode'=> '736135',
            'state' => 'West Bengal',
            'country' => 'India',
            'google_maps_link' => 'gyggyyg',
           
    ]);

    return redirect()->route('admin.ambulance.index')
        ->with('success', 'Ambulance created successfully!');
}

    public function edit($id)
    {
        $ambulance = Ambulance::findOrFail($id);
        return view('admin_panel.ambulaceAction', compact('ambulance'));
    }

    public function update(Request $request, $id){

$validated = $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'phone' => 'required|string',
        'email' => 'required|email',
        'vehicle_number' => 'required',
        'service_type' => 'required|in:BLS,ALS,ICU,other',
        'organization_type' => 'required|in:government,private,public',
        'status' => 'required|boolean',
        'image' => 'required|mimes:jpeg,png,jpg|max:2048'
    ]);
        Ambulance::findOrFail($id)->update($validated);


        // if ($request->has('services')) {
        //     $doctor->services()->sync($request->services);
        // }

        // if ($request->has('hospitals')) {
        //     $doctor->hospitals()->sync($request->hospitals);
        // }

        return redirect()->route('admin.ambulance.index')->with('success', 'Ambulance updated successfully');
    }

    public function destroy($id){
Ambulance::findOrFail($id)->delete($id);
        return redirect()->route('admin.ambulance.index')->with('success', 'Ambulance updated successfully');

    }

    public function createBlade(){
        return view('admin_panel.hospital_Create');
    }

}
