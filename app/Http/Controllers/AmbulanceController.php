<?php

namespace App\Http\Controllers;

use App\Models\Ambulance;
use Illuminate\Http\Request;

class AmbulanceController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $ambulances = Ambulance::where('status', '1')->orderBy('created_at', 'DESC')->paginate(6);
        // $ambulances = Ambulance::query()->with('location');

        // if ($search) {
        //     $ambulances->where(function ($query) use ($search) {
        //         $query->where('first_name', 'like', "%$search%")
        //             ->orWhere('last_name', 'like', "%$search%")
        //             ->orWhere('email', 'like', "%$search%")
        //             ->orWhere('phone', 'like', "%$search%");
        //     });
        // } else {
        //     $ambulances->where('status', '1');
        // }

        // $ambulances = $ambulances->orderBy('created_at', 'DESC')->paginate(6);

        // if ($request->ajax()) {
        //     return response()->json([
        //         'data' => $ambulances->items(),
        //         'links' => $ambulances->links()->toHtml()
        //     ]);
        // }
        

        return view('user_panel.ambulances', compact('ambulances'));
    }

    public function search(Request $request)
    {
        // dd($request->searchStr);


        $search = $request->searchStr;
        $ambulances = Ambulance::where('first_name', 'like', "%$search%")
            ->orWhere('last_name', 'like', "%$search%")
            ->orWhere('email', 'like', "%$search%")
            ->orWhere('phone', 'like', "%$search%")
            ->orderBy('created_at', 'DESC')
            ->paginate(6);

        if ($ambulances->count() >= 1) {
            $html = view('user_panel.ambulances', compact('ambulances'))->render();
            return response()->json(['status' => 'success', 'html' => $html]);
        } else {
            return response()->json(['status' => 'nothing_found']);
        }


        $search = $request->searchStr;
        $ambulances = Ambulance::where('first_name', 'like', "%$search%")
            ->orWhere('last_name', 'like', "%$search%")
            ->orWhere('email', 'like', "%$search%")
            ->orWhere('phone', 'like', "%$search%")
            ->orderBy('created_at', 'DESC')
            ->paginate(6);

        if ($ambulances->count() >= 1) {
            $html = view('user_panel.ambulances', compact('ambulances'))->render();
            return response()->json(['status' => 'success', 'html' => $html]);
        } else {
            return response()->json(['status' => 'nothing_found']);
        }
    }
}
