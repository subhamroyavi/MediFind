<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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

Route::get('/', [IndexController::class, 'index'])->name('index');

Route::get('user_panel/hospitals', [HospitalController::class, 'index'])->name('hospitals.view');
Route::get('user_panel/hospital-details', [HospitalController::class, 'hospital_details'])->name('hospitals.details');

Route::get('user_panel/doctors', [DoctorController::class, 'index'])->name('doctors');
Route::get('/doctor-details', [DoctorController::class, 'doctor_details'])->name('doctors.details');

Route::get('/ambulances', [AmbulanceController::class, 'index'])->name('ambulances.view');

Route::get('/about', [AboutController::class, 'about_index'])->name('about.view');
Route::get('/emergency', [EmergencyController::class, 'emergency_index'])->name('emergency.view');
Route::get('/contact', [ContactController::class, 'contact_index'])->name('contact.view');

Route::get('/login', [SignupController::class, 'login'])->name('login');
Route::get('/signup', [SignupController::class, 'signup'])->name('signup');
Route::get('/profile', [UserController::class, 'profile'])->name('profile');

// --------------------------------------// login route-----------------------------------------------------------------

// ---------------------------------------------------------------------------------------------------------------------
Route::get('/hospital-admin/signup', [AdminLoginController::class, 'signup'])->name('admin.signup');
Route::post('/hospital-admin/signup', [AdminLoginController::class, 'createUser'])->name('admin.create');
Route::get('/hospital-admin/login', [AdminLoginController::class, 'login'])->name('admin.login');
Route::post('/hospital-admin/login-check', [AdminLoginController::class, 'loginCheck'])->name('admin.login-check');
Route::get('/hospital-admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

// ---------------------------------------------------------------------------------------------------------------------
// ---------------------------------------------------------------------------------------------------------------------
Route::middleware(['check-login'])->group(function () {

    // Dashboard Route
    Route::get('/hospital-admin', [AdminController::class, 'adminIndex'])->name('admin.dashboard');

   
    // User Management Routes
    Route::get('/hospital-admin/users', [AdminController::class, 'adminUserView'])->name('admin.users');
    Route::post('/hospital-admin/users', [AdminController::class, 'storeUser'])->name('admin.users.store');
    Route::get('/hospital-admin/users/{user}', [AdminController::class, 'getUser'])->name('admin.users.show');
    Route::put('/hospital-admin/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/hospital-admin/users/{user}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');
    Route::post('/hospital-admin/users/toggle-status', [AdminController::class, 'toggleStatus'])->name('admin.users.toggle-status');
    // Route::get('/hospital-admin/{user}/toggle-status', [AdminController::class, 'toggleStatus'])->name('admin.toggle-status');

    //service Management 
    Route::get('/hospital-admin/services', [ServiceController::class, 'serviceView'])->name('admin.services');
    Route::get('/hospital-admin/services/create', [ServiceController::class, 'create'])->name('admin.services.create');
    Route::get('/hospital-admin/services/edit/{id}', [ServiceController::class, 'edit'])->name('admin.services.edit');
    Route::post('/hospital-admin/services/update/{id}', [ServiceController::class, 'update'])->name('admin.services.update');
    Route::get('/hospital-admin/services/{id}', [ServiceController::class, 'destroy'])->name('admin.services.destroy');

    //doctor management
    Route::get('doctors', [AdminDoctorController::class, 'index'])->name('admin.doctors.index');
    Route::get('doctors/create', [AdminDoctorController::class, 'create'])->name('admin.doctors.create');
    Route::post('doctors', [AdminDoctorController::class, 'store'])->name('admin.doctors.store');
    Route::get('doctors/{id}/edit', [AdminDoctorController::class, 'edit'])->name('admin.doctors.edit');
    Route::put('doctors/{id}', [AdminDoctorController::class, 'update'])->name('admin.doctors.update');
    Route::delete('doctors/{id}', [AdminDoctorController::class, 'destroy'])->name('admin.doctors.destroy');

    Route::get('doctors/test', [AdminDoctorController::class, 'test'])->name('admin.doctors.test');

    //ambulace management
    Route::get('ambulance', [AdminAmbulanceController::class, 'index'])->name('admin.ambulance.index');
    Route::get('ambulance/create', [AdminAmbulanceController::class, 'create'])->name('admin.ambulance.create');
    Route::post('ambulance/store', [AdminAmbulanceController::class, 'store'])->name('admin.ambulance.store');
    Route::post('ambulance/view/{id}', [AdminAmbulanceController::class, 'view'])->name('admin.ambulance.view');
    Route::get('ambulance/edit/{id}', [AdminAmbulanceController::class, 'edit'])->name('admin.ambulance.edit');
    Route::post('ambulance/update/{id}', [AdminAmbulanceController::class, 'update'])->name('admin.ambulance.update');
    Route::get('ambulance/destroy/{id}', [AdminAmbulanceController::class, 'destroy'])->name('admin.ambulance.destroy');

    Route::get('ambulance/createBlade', [AdminAmbulanceController::class, 'createBlade'])->name('admin.ambulance.createBlade');
    Route::get('ambulance/blade', [AdminAmbulanceController::class, 'blade'])->name('admin.ambulance.createBlade');


     // Hospital Routes
    Route::get('hospitals', [AdminHospitalController::class, 'index'])->name('admin.hospitals');
    Route::get('hospitals/create', [AdminHospitalController::class, 'create'])->name('admin.hospital.create');
    Route::post('hospitals/store', [AdminHospitalController::class, 'store'])->name('admin.hospital.store');
    Route::get('hospitals/edit/{id}', [AdminHospitalController::class, 'edit'])->name('admin.hospital.edit');
    Route::post('hospitals/update/{id}', [AdminHospitalController::class, 'update'])->name('admin.hospital.update');
    Route::get('hospitals/destroy/{id}', [AdminHospitalController::class, 'destroy'])->name('admin.hospital.destroy');

});
