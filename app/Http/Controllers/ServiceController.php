<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    public function serviceView(Request $request)
    {
        $search = $request->search;
        $editService = null; // Initialize edit service variable
        
        if ($search) {
            $services = Service::where('service_id', 'like', "%$search%")
                ->orWhere('service_name', 'like', "%$search%")
                ->orderBy('created_at', 'DESC')->paginate(5)->withQueryString();
        } else {
            $services = Service::orderBy('created_at', 'DESC')->paginate(5);
        }

        return view('admin_panel.medical-services', compact('services', 'editService'));
    }

    public function create(Request $request)
{
    $validated = $request->validate([
        'service_name' => 'required|string',
    ]);

    // dd($request->all());

    $Service = Service::create(['service_name' => $validated['service_name']]);

    return redirect()->route('admin.services')->with('success', 'Service created successfully!');
}

public function edit($id)
    {
        $editService = Service::where('service_id', $id)->firstOrFail();
        $services = Service::orderBy('created_at', 'DESC')->paginate(5);
        // dd($editService);
        
        return view('admin_panel.medical-services', compact('services', 'editService'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'service_name' => 'required|string',
        ]);

        Service::findOrFail($id)->update($validated);


        // $service = Service::where('service_id', $id)->firstOrFail();
        // $service->update(['service_name' => $validated['service_name']]);

        return redirect()->route('admin.services')->with('success', 'Service updated successfully!');
    }

    public function destroy($id){
        Service::findOrFail($id)->delete();
        return redirect()->route('admin.services')->with('done', 'deleted done');

    }
}
