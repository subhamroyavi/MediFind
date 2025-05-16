<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use Illuminate\Http\Request;

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
        return view('admin_panel.hospitalAction');
    }

    public function store(Request $request) {

        // dd($request->all());
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

    Hospital::create($validated);

    return redirect()->route('admin.hospitals')
        ->with('success', 'Hospital created successfully!');
}
public function edit($id){

    $hospital = Hospital::findOrFail($id);
     return view('admin_panel.hospitalAction', compact('hospital'));
}

public function update(Request $request, $id){
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

public function destroy($id){
 Hospital::findOrFail($id)->delete();

    return redirect()->route('admin.hospitals')
        ->with('success', 'Hospital created successfully!');
}
}
