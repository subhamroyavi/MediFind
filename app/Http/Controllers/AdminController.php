<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Ambulance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function adminUserView(Request $request)
    {
        $users = User::orderBy('created_at', 'DESC')->paginate(5);

        return view('admin_panel.users', compact('users'));
    }

    public function updateProfile(Request $request)
    {
        // dd($request->toArray());
        $id =  Auth::guard('admin')->user()->id;
        $user = User::findOrFail($id);

        $userData = $request->validate([
            'first_name' => 'nullable',
            'last_name' => 'nullable',
            'email' => 'nullable|email',
            'phone' => 'nullable|numeric',
            'bloodType' => 'nullable',
            'image' => 'nullable',
            'address' => 'nullable',
            'gender' => 'nullable',
            'dob' => 'nullable',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('profiles', 'public');
            $userData['image'] = $path;
        }

        $user->update($userData);

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        $user = Auth::guard('admin')->user();

        // Check if current password matches
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('admin.profile')->with('success', 'Password updated successfully.');
    }

    public function destroyUser($user)
    {
        $User = User::findOrFail($user);
        // dd($user);
        $User->delete();
        return back()->with('success', 'User deleted successfully.');
    }

    public function adminIndex()
    {
        $totalUsers = User::count();
        $activeUsers = User::where('status', true)->count();
        $inactiveUsers = User::where('status', false)->count();
        // $recentUsers = User::latest()->take(5)->get();

        $totalHospitals = Hospital::count();
        $activeHospitals = Hospital::where('status', true)->count();
        $inactiveHospitals = Hospital::where('status', false)->count();

        $totalDoctors = Doctor::count();
        $activeDoctors = Doctor::where('status', true)->count();
        $inactiveDoctors = Doctor::where('status', false)->count();

        $totalAmbulances = Ambulance::count();
        $activeAmbulances = Ambulance::where('status', true)->count();
        $inactiveAmbulances = Ambulance::where('status', false)->count();

        return view('admin_panel.dashboard', compact(
            'totalUsers',
            'activeUsers',
            'inactiveUsers',
            'totalHospitals',
            'activeHospitals',
            'inactiveHospitals',
            'totalDoctors',
            'activeDoctors',
            'inactiveDoctors',
            'totalAmbulances',
            'activeAmbulances',
            'inactiveAmbulances'
        ));
    }

    public function index()
    {
        return view('admin_panel.hospitals');
    }

    public function create()
    {
        return view('admin_panel.hospital_Create');
    }

    public function updateUserStatus(Request $request, $user)
    {
        // dd($request);
        $user = User::findOrFail($request->user);

        $userData = $request->validate([
            'status' => 'boolean',
        ]);

        $user->update($userData);

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

    public function header()
    {
        return view('layouts.admin.header');
    }
    public function header1()
    {
        return view('layouts.admin.header1');
    }
}
