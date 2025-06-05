<?php

namespace App\Http\Controllers;

use App\Models\Ambulance;
use Illuminate\Http\Request;

class AmbulanceController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        if ($search) {
            $ambulances = Ambulance::with('location')
                ->where(function ($query) use ($search) {
                    $query->where('first_name', 'like', "%$search%")
                        ->orWhere('last_name', 'like', "%$search%")
                        ->orWhere('phone', 'like', "%$search%")
                        ->orWhere('email', 'like', "%$search%")
                        ->orWhere('vehicle_number', 'like', "%$search%")
                        ->orWhere('vehicle_model', 'like', "%$search%")
                        ->orWhere('service_type', 'like', "%$search%")
                        ->orWhere('organization_type', 'like', "%$search%")
                        ->orWhereHas('location', function ($q) use ($search) {
                            $q->where('address_line1', 'like', "%$search%")
                                ->orWhere('address_line2', 'like', "%$search%")
                                ->orWhere('city', 'like', "%$search%")
                                ->orWhere('district', 'like', "%$search%")
                                ->orWhere('state', 'like', "%$search%")
                                ->orWhere('pincode', 'like', "%$search%")
                                ->orWhere('country', 'like', "%$search%");
                        });
                })
                ->orderBy('created_at', 'DESC')
                ->paginate(9)
                ->withQueryString();

        } else {
            // $ambulances = Ambulance::with('location')->orderBy('created_at', 'DESC')->paginate(5);
            $ambulances = Ambulance::where('status', '1')
                ->with('location')
                ->orderBy('created_at', 'DESC')
                ->paginate(6);
        }

        return view('user_panel.ambulances', compact('ambulances'));
    }
}
