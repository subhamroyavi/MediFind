<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function profile()
    {
        return view('user_panel.profile');
    }

    public function updateProfile(Request $request)
    {
        // dd($request->toArray());
        $id = Auth::user()->id;

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

        $user = Auth::user();

        // Check if current password matches
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('profile')->with('success', 'Password updated successfully.');
    }
}
