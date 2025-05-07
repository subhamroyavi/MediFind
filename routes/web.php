<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AmbulanceController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\EmergencyController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\IndexController;
use Illuminate\Support\Facades\Route;

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


