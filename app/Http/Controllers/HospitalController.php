<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class HospitalController extends Controller
{
    public function index(Request $request)
    {

        $search = $request->search;

        if ($search) {

            $hospitals = Hospital::with(['contacts', 'facilities', 'services', 'openingDays', 'location'])
                ->where(function ($query) use ($search) {
                    $query->where('hospital_name', 'like', "%$search%")
                        ->orWhere('organization_type', 'like', "%$search%")
                        ->orWhereHas('location', function ($q) use ($search) {
                            $q->where('address_line1', 'like', "%$search%")
                                ->orWhere('address_line2', 'like', "%$search%")
                                ->orWhere('city', 'like', "%$search%")
                                ->orWhere('district', 'like', "%$search%")
                                ->orWhere('state', 'like', "%$search%")
                                ->orWhere('pincode', 'like', "%$search%")
                                ->orWhere('country', 'like', "%$search%");
                        })
                        ->orWhereHas('services', function ($q) use ($search) {
                            $q->where('service_name', 'like', "%$search%");
                        });
                })
                ->orderBy('created_at', 'DESC')
                ->paginate(9)
                ->withQueryString();
        } else {
            $hospitals = Hospital::with(['contacts', 'facilities', 'services', 'openingDays', 'location'])
                ->where('status', '1')
                ->orderBy('created_at', 'DESC')
                ->paginate(9);
        }

        return view('user_panel.hospitals', compact('hospitals'));
    }

    public function hospital_details($id)
    {

        $hospital = Hospital::with(['facilities', 'services', 'openingDays', 'location'])->findOrFail($id);
        return view('user_panel.hospital-details', compact('hospital'));
    }
}
