<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use function Laravel\Prompts\password;
use Illuminate\Support\Facades\Validator;

class AdminLoginController extends Controller
{
    public function signup()
    {
        return view('admin_panel.signup');
    }

    public function createUser(Request $req)
    {
        // print_r($req->all());

        // Validate the request
        $validated = $req->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:users',
            'phone' => 'required|string|max:15',
            'password' => 'required|min:6|max:20'
        ]);

        // Create user
        $user = User::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            // 'password' => bcrypt($validated['password']),
            'password' => Hash::make($validated['password']),
            'status' => 1
        ]);

        // print_r($user);


        // Return JSON with redirect URL
        return response()->json([
            'success' => true,
            'message' => 'Registration successful!',
            'redirect' => route('admin.dashboard')
        ]);
    }

    public function login()
    {
        return view('admin_panel.login');
    }

    public function loginCheck(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|max:20'
        ]);

        // Find active user by email
        if ($validated) {
            $user = User::where([
                'email' => $request->email,
                'status' => 1
            ])->first();
        }

        // Verify user exists AND password matches
        // if ($user && Hash::check($request->password, $user->password)) {
        if ($user) {
            // Manually log in the user
            $request->session()->put([
                'authenticated' => true,
                'user_id' => $user->id,
                'user_email' => $user->email
            ]);

            $request->session()->regenerate();

            return response()->json([
                'success' => true,
                'message' => 'Login successful!',
                'redirect' => route('admin.dashboard')
            ]);
        }

        return response()->json([
            'success' => false,
            'errors' => ['email' => 'Invalid credentials']
        ], 422);
    }

    // public function loginCheck(Request $request)
    // {
    //     $validated = $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required'
    //     ]);

    //     // Find user by email only
    //     $user = User::where('email', $validated['email'])->first();

    //     // Check if user exists and password matches
    //     if ($user && Hash::check($request->password, $user->password)) {
    //         // Manually log in the user
    //         $request->session()->put([
    //             'authenticated' => true,
    //             'user_id' => $user->id,
    //             'user_email' => $user->email
    //         ]);

    //         // Regenerate session ID for security
    //         $request->session()->regenerate();

    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Login successful!',
    //             'redirect' => route('admin.dashboard')
    //         ]);
    //     }

    //     // Authentication failed
    //     return response()->json([
    //         'success' => false,
    //         'errors' => ['email' => 'The provided credentials do not match our records.']
    //     ], 422);
    // }

    public function logout()
    {
        session::forget('user');
        Session::flush('user');

        return redirect()->route('admin.login');
    }
}
