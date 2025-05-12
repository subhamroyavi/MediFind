<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    public function serviceView(Request $request)
    {
        $search = $request->search;
        if ($search) {
            $services = Service::where('service_id', 'like', "%$search%")
                ->orWhere('service_name', 'like', "%$search%")
                ->orderBy('created_at', 'DESC')->paginate(5)->withQueryString();
        } else {
        $services = Service::orderBy('created_at', 'DESC')->paginate(5);
        // dd($services);
        }
        return view('admin_panel.medical-services', compact('services'));
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
}
