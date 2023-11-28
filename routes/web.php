<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\UserController;
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

Route::get('/', [AuthController::class, 'landing']);
Route::view('/login', 'index')->name('login');
Route::post('/', [AuthController::class, 'login']);
Route::get('/sign-up', [AuthController::class, 'signup']);
Route::post('/sign-up', [UserController::class, 'store']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::group(["prefix" => "patient", "middleware" => ["auth", "isPatient"], "as" => "patient."], function () {
    Route::get('/', [ScheduleController::class, 'create']);
    Route::post('/chat', [ScheduleController::class, 'store']);
    Route::get('/schedules', [ScheduleController::class, 'index']);
    Route::resource('/testimonies', TestimonialController::class)->only('index', 'store', 'destory');
    Route::get('/testimonies/{testimonial}', [TestimonialController::class, 'destroy']);
    Route::view('/settings', 'patient.settings');
    Route::post('/settings', [PatientController::class, 'update']);
    Route::get('/payments', [PaymentController::class, 'patientList']);
    Route::post('/payments', [PaymentController::class, 'update']);
});

Route::group(["prefix" => "doctor", "middleware" => ["auth", "isDoctor"], "as" => "doctor."], function () {
    Route::get('/', [ScheduleController::class, 'index']);
    Route::view('/settings', 'doctor.settings');
    Route::resource('/testimonies', TestimonialController::class)->only('index', 'store', 'destory');
    Route::get('/testimonies/{testimonial}', [TestimonialController::class, 'destroy']);
    Route::post('/settings', [DoctorController::class, 'update']);
    Route::get('/report', [ScheduleController::class, 'report']);
});

Route::group(["prefix" => "admin", "middleware" => ["auth", "isAdmin"], "as" => "admin."], function () {
    Route::resource('/', AdminController::class)->only('index', 'store');
    Route::get('/admins/{id}', [AdminController::class, 'destroy']);
    Route::resource('/doctors', DoctorController::class)->only('index', 'store');
    Route::get('/doctors/{id}', [DoctorController::class, 'destroy']);
    Route::get('/settings', [AdminController::class, 'create']);
    Route::post('/settings', [AdminController::class, 'update']);
    Route::get('/payments', [PaymentController::class, 'index']);
    Route::get('/report', [ScheduleController::class, 'report']);
    Route::post('/patients', [PatientController::class, 'print']);
});
