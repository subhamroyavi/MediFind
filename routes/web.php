<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;


use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\AmbulanceController;

use App\Http\Controllers\EmergencyController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\AdminDoctorController;
use App\Http\Controllers\AdminHospitalController;
use App\Http\Controllers\AdminAmbulanceController;
use App\Http\Controllers\AdminSignupController;
use App\Http\Controllers\ForgotPasswordController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// --------------------------------------// User-dashboard route-----------------------------------------------------------------

Route::get('/', function () {
    return redirect()->route('index');  // Correct redirect
});
Route::get('/medifind', [IndexController::class, 'index'])->name('index');

Route::view('/medifind/login', 'user_panel.login')->name('login');
Route::view('/medifind/signup', 'user_panel.signup')->name('signup');
Route::post('/medifind/login-check', [SignupController::class, 'login'])->name('login-check');
Route::post('/medifind/store', [SignupController::class, 'store'])->name('store-user');
// Send OTP
Route::post('/medifind/send-otp', [SignupController::class, 'sendOTP'])->name('send.otp');
Route::get('/medifind/verify', [SignupController::class, 'otpPage'])->name('otp-page');
// Verify OTP
Route::post('/medifind/verify-otp', [SignupController::class, 'verifyOTP'])->name('verify.otp');
Route::get('/medifind/logout', [SignupController::class, 'logout'])->name('logout');

Route::view('/medifind/forgot-password', 'user_panel.foggetPassword')->name('forgot-password');
Route::post('/send-otp', [ForgotPasswordController::class, 'sendOtp'])->name('forgot-email-sendOTP');
Route::post('/verify-otp', [ForgotPasswordController::class, 'verifyOtp'])->name('forgot-email-verifyOTP');
Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('forgot-email-resetPassword');


Route::middleware(['user-loginCheck'])->group(function () {

    // Route::get('medifind/profile', [UserController::class, 'profile'])->name('profile');
    Route::view('/medifind/profile', 'user_panel.profile')->name('profile');
    Route::post('/medifind/profile/update',  [UserController::class, 'updateProfile'])->name('profile-update');
    Route::post('/medifind/profile/change-password',  [UserController::class, 'changePassword'])->name('change-password');

    Route::get('/medifind/hospitals', [HospitalController::class, 'index'])->name('hospitals.view');
    Route::get('/medifind/hospital-details/{id}', [HospitalController::class, 'hospital_details'])->name('hospitals.details');

    // Route::get('user_panel/hospitals-search', [HospitalController::class, 'hospital_details'])->name('hospitals-search');

    Route::get('/medifind/doctors', [DoctorController::class, 'index'])->name('doctors');
    Route::get('/medifind/doctor-details/{id}', [DoctorController::class, 'doctor_details'])->name('doctor-details');

    Route::get('/medifind/ambulances', [AmbulanceController::class, 'index'])->name('ambulances.view');
    Route::get('/medifind/ambulance-search', [AmbulanceController::class, 'search'])->name('ambulance-search');
});
Route::get('/medifind/about', [AboutController::class, 'about_index'])->name('about.view');
Route::get('/medifind/emergency', [EmergencyController::class, 'emergency_index'])->name('emergency.view');
Route::get('/medifind/contact', [ContactController::class, 'contact_index'])->name('contact.view');

// --------------------------------------// Admin-dashboard route-----------------------------------------------------------------

Route::get('/admin-dashboard/header', [AdminController::class, 'header'])->name('header');
Route::get('/admin-dashboard/header1', [AdminController::class, 'header1'])->name('header1');

Route::view('/admin-dashboard/signup', 'admin_panel.signup')->name('admin.signup');
// Route::view('/admin-dashboard/login', 'admin_panel.login')->name('admin.signup');
Route::post('/admin-dashboard/sendOTP', [AdminSignupController::class, 'sendOTP'])->name('admin.sendOTP');
Route::get('/admin-dashboard/OTP-page', [AdminSignupController::class, 'otpPage'])->name('admin-OTPPage');
Route::post('/admin-dashboard/OTP-verify', [AdminSignupController::class, 'verifyOTP'])->name('admin-OTPVerify');

// Route::get('/admin-dashboard/login', [AdminLoginController::class, 'login'])->name('admin.login-page');
Route::view('/admin-dashboard/login', 'admin_panel.login')->name('admin.login-page');
Route::post('/admin-dashboard/login-check', [AdminSignupController::class, 'loginCheck'])->name('admin.login-check');
Route::get('/admin-dashboard/logout', [AdminSignupController::class, 'logout'])->name('admin.logout');
Route::middleware(['admin-loginCheck'])->group(function () {

    // Dashboard Route
    Route::get('/admin-dashboard', [AdminController::class, 'adminIndex'])->name('admin.dashboard');
    Route::view('admin-dashboard/user', 'admin_panel.user');

    // User Management Routes
    Route::get('/admin-dashboard/users', [AdminController::class, 'adminUserView'])->name('admin.users');
    Route::post('/admin-dashboard/users', [AdminController::class, 'storeUser'])->name('admin.users.store');
    Route::get('/admin-dashboard/users/{user}', [AdminController::class, 'getUser'])->name('admin.users.show');
    Route::put('/admin-dashboard/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::post('/admin-dashboard/users/{user}', [AdminController::class, 'updateUserStatus'])->name('admin.users-status.update');
    Route::get('/admin-dashboard/delete/{user}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');
    Route::post('/admin-dashboard/users/toggle-status', [AdminController::class, 'toggleStatus'])->name('admin.users.toggle-status');
    // Route::get('admin-dashboard/{user}/toggle-status', [AdminController::class, 'toggleStatus'])->name('admin.toggle-status');

    // Hospital Routes
    Route::get('/admin-dashboard/hospitals', [AdminHospitalController::class, 'index'])->name('admin.hospital');
    Route::get('/admin-dashboard/hospitals/create', [AdminHospitalController::class, 'create'])->name('admin.hospital.create');
    Route::post('/admin-dashboard/hospitals/store', [AdminHospitalController::class, 'store'])->name('admin.hospital.store');
    Route::get('/admin-dashboard/hospitals/edit/{id}', [AdminHospitalController::class, 'edit'])->name('admin.hospital.edit');
    Route::post('/admin-dashboard/hospitals/update/{id}', [AdminHospitalController::class, 'update'])->name('admin.hospital.update');
    Route::get('/admin-dashboard/hospitals/destroy/{id}', [AdminHospitalController::class, 'destroy'])->name('admin.hospital.destroy');

    //doctor management
    Route::get('/admin-dashboard/doctors', [AdminDoctorController::class, 'index'])->name('admin.doctors.index');
    Route::get('/admin-dashboard/doctors/create', [AdminDoctorController::class, 'create'])->name('admin.doctors.create');
    Route::post('/admin-dashboard/doctors', [AdminDoctorController::class, 'store'])->name('admin.doctors.store');
    Route::get('/admin-dashboard/doctors/edit/{id}', [AdminDoctorController::class, 'edit'])->name('admin.doctors.edit');
    Route::post('/admin-dashboard/doctors/{id}', [AdminDoctorController::class, 'update'])->name('admin.doctors.update');
    Route::get('/admin-dashboard/doctors/{id}', [AdminDoctorController::class, 'destroy'])->name('admin.doctors.destroy');
    Route::get('/admin-dashboard/doctors/test', [AdminDoctorController::class, 'test'])->name('admin.doctors.test');

    //ambulace management
    Route::get('/admin-dashboard/ambulances', [AdminAmbulanceController::class, 'index'])->name('admin.ambulance.index');
    Route::get('/admin-dashboard/ambulances/create', [AdminAmbulanceController::class, 'create'])->name('admin.ambulance.create');
    Route::post('/admin-dashboard/ambulances/store', [AdminAmbulanceController::class, 'store'])->name('admin.ambulance.store');
    Route::post('/admin-dashboard/ambulances/view/{id}', [AdminAmbulanceController::class, 'view'])->name('admin.ambulance.view');
    Route::get('/admin-dashboard/ambulances/edit/{id}', [AdminAmbulanceController::class, 'edit'])->name('admin.ambulance.edit');
    Route::post('/admin-dashboard/ambulances/update/{id}', [AdminAmbulanceController::class, 'update'])->name('admin.ambulance.update');
    Route::get('/admin-dashboard/ambulances/destroy/{id}', [AdminAmbulanceController::class, 'destroy'])->name('admin.ambulance.destroy');

    //service Management 
    Route::get('/admin-dashboard/services', [ServiceController::class, 'serviceView'])->name('admin.services');
    Route::get('/admin-dashboard/services/create', [ServiceController::class, 'create'])->name('admin.services.create');
    Route::get('/admin-dashboard/services/edit/{id}', [ServiceController::class, 'edit'])->name('admin.services.edit');
    Route::post('/admin-dashboard/services/update/{id}', [ServiceController::class, 'update'])->name('admin.services.update');
    Route::get('/admin-dashboard/services/{id}', [ServiceController::class, 'destroy'])->name('admin.services.destroy');
});
