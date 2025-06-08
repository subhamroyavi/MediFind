<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\VerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;

class SignupController extends Controller
{
    public function sendOTP(Request $request)
    {
        // dd($request->toArray());
        $userData = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'bloodType' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'password' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = 'users_' . time() . '_' . $image->getClientOriginalName();
            $path = $image->storeAs('public/users', $filename);
            $userData['image'] = 'users/' . $filename;
        } else {
            $userData['image'] = null;
        }

        // Hash the password before saving (unless you're using mutators or Laravel Breeze/Fortify)
        $userData['password'] = bcrypt($userData['password']);

        // User::create($userData);


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

        // return redirect()->route('otp-page')
        //     ->with([
        //         'email' => $email,
        //         'success' => 'OTP sent successfully!'
        //     ]);


        return view('user_panel.otpVerify', [
            'userData' => $userData,
            'email' => $userData['email'],
            'success' => 'OTP sent successfully!'
        ]);
    }

    public function otpPage()
    {
        return view('user_panel.otpVerify');
    }

    public function verifyOTP(Request $request)
    {
        // print_r($request);
        $userData = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'bloodType' => 'required',
            'image' => 'nullable',
            'password' => 'required',
        ]);

        // Hash the password before saving (unless you're using mutators or Laravel Breeze/Fortify)
        $userData['password'] = bcrypt($userData['password']);


        $email = $request->email;
        $userOTP = $request->otp;
        $storedOTP = Cache::get('otp_' . $email);

        if ($storedOTP && $userOTP == $storedOTP) {
            // OTP is valid
            Cache::forget('otp_' . $email); // Clear OTP after successful verification

            User::create($userData);

            // Here you would typically log the user in or mark their email as verified
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
}
