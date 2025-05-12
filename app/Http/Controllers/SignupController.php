<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SignupController extends Controller
{
    public function login(){
        return view('user_panel.login');
    }

    public function signup(){
        return view('user_panel.signup');
    }
}
