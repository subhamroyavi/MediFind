<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\VerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;


class AdminSignupController extends Controller
{
    public function sendOTP(Request $request)
    {
        // dd($request->toArray());
        $userData = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|numeric',
            'bloodType' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'password' => 'required',
            'user_status' => 'required'
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = 'users_' . time() . '_' . $image->getClientOriginalName();
            $path = $image->storeAs('public/users', $filename);
            $userData['image'] = 'users/' . $filename;
        } else {
            $userData['image'] = null;
        }

        $userData['password'] = Hash::make($userData['password']);

        $email = $request->email;
        $otp = rand(100000, 999999); // 6-digit OTP
        $sub = $request->first_name;
        $msg =  $request->password;

        // Store OTP in cache for 5 minutes
        Cache::put('otp_' . $email, $otp, now()->addMinutes(5));

        // Send OTP via email
        Mail::to($email)->send(new VerifyEmail($msg, $sub, $otp));

        // return response()->json([
        //     'message' => 'OTP sent successfully',
        //     'email' => $email // Return email for verification form
        // ]);
        return view('admin_panel.otp', [
            'userData' => $userData,
            'email' => $userData['email'],
            'success' => 'OTP sent successfully!'
        ]);
    }

    public function otpPage()
    {
        return view('admin_panel.otp');
    }

    public function verifyOTP(Request $request)
    {
        // dd($request->toArray());
        $userData = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'bloodType' => 'required',
            'image' => 'nullable',
            'password' => 'required',
            'user_status' => 'required'
        ]);

        $email = $request->email;
        $userOTP = $request->otp;
        $storedOTP = Cache::get('otp_' . $email);

        if ($storedOTP && $userOTP == $storedOTP) {
            // OTP is valid
            Cache::forget('otp_' . $email);
            User::create($userData);
            // User::create(array_merge(['user_status' => 'user'], $userData));

            return response()->json([
                'success' => true,
                'message' => 'OTP verified successfully'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Invalid OTP'
        ], 422);
    }
    public function loginCheck(Request $request)
    {
        // Validate the incoming request data
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Get user by email
        $user = User::where('email', $credentials['email'])
            ->where('user_status', 'Admin')
            ->where('status', 1)
            ->first();

        // Check if user exists and password is correct
        if ($user && Hash::check($credentials['password'], $user->password)) {
            Auth::login($user); // manually log in the user
            $request->session()->regenerate();

            session([
                'authenticated' => true,
                'user_id' => $user->id,
                'user_email' => $user->email,
            ]);

            return redirect()->route('index');
        }
        return back()->withErrors([
            'email' => 'Invalid credentials !',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Session::forget('authenticated');
        Session::forget('user_id');
        Session::forget('user_email');

        return redirect()->route('admin.login-page');
    }
}
