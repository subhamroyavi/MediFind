<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Hospital;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class IndexController extends Controller
{
    public function index()
    {

        $hospitals = Hospital::with(['contacts', 'facilities', 'services', 'openingDays', 'location'])
            ->where('status', '1')
            ->orderBy('created_at', 'DESC')
            ->paginate(6);

        $doctors = Doctor::with(['locations', 'experiences', 'educations'])
            ->orderBy('created_at', 'DESC')
            ->paginate(6);
        // dd($doctorData->toArray());


        return view('user_panel.welcome', compact(['hospitals', 'doctors']));
    }
}
