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
        $request->validate([
            'email' => 'required|email'
        ]);

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

        return view('user_panel.otpVerify')->with([
            'email' => $email,
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
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|numeric'
        ]);

        $email = $request->email;
        $userOTP = $request->otp;
        $storedOTP = Cache::get('otp_' . $email);

        if ($storedOTP && $userOTP == $storedOTP) {
            // OTP is valid
            Cache::forget('otp_' . $email); // Clear OTP after successful verification

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
