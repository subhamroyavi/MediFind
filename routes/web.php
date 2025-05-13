<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AdminDoctorController;


use App\Http\Controllers\AmbulanceController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\EmergencyController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;

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

Route::get('/hospitals', [HospitalController::class, 'index'])->name('hospitals.view');
Route::get('/hospital-details', [HospitalController::class, 'hospital_details'])->name('hospitals.details');

Route::get('/doctors', [DoctorController::class, 'index'])->name('doctors.view');
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
// Route::post('/debug-login', function (Request $req) {
//    // Convert to object
//     $data = (object)$req->all();

//     return response()->json([
//         'email' => $data->email,
//         'password' => $data->password
//     ]);
// });
Route::get('/hospital-admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

// ---------------------------------------------------------------------------------------------------------------------
// ---------------------------------------------------------------------------------------------------------------------
Route::group(['middleware' => 'check-login'], function () {
    // Dashboard Route
    Route::get('/hospital-admin', [AdminController::class, 'adminIndex'])->name('admin.dashboard');

    // Hospital Routes
    Route::get('/hospital-admin/hospitals', [AdminController::class, 'adminHospitalView'])->name('admin.hospitals');
    Route::get('/hospital-admin/hospitals/create', [AdminController::class, 'adminHospitalCreate'])->name('admin.hospitals-create');

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
    Route::resource('doctors', AdminDoctorController::class)->names([
        'index'   => 'admin.doctors.index',
        'create'  => 'admin.doctors.create',
        'store'   => 'admin.doctors.store',
        'show'    => 'admin.doctors.show',
        'edit'    => 'admin.doctors.edit',
        'update'  => 'admin.doctors.update',
        'destroy' => 'admin.doctors.destroy'
    ]);
    Route::post('doctors/{doctor}/services', [AdminDoctorController::class, 'addService'])->name('doctors.add-service');
    Route::delete('doctors/{doctor}/services/{service}', [AdminDoctorController::class, 'removeService'])->name('doctors.remove-service');
    Route::post('doctors/{doctor}/hospitals', [AdminDoctorController::class, 'assignHospital'])->name('doctors.assign-hospital');
    Route::delete('doctors/{doctor}/hospitals/{hospital}', [AdminDoctorController::class, 'unassignHospital'])->name('doctors.unassign-hospital');
});
