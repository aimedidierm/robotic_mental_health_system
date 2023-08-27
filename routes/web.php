<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DoctorController;
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

Route::view('/', 'index')->name('login');
Route::post('/', [AuthController::class, 'login']);
Route::view('/sign-up', 'sign-up');
Route::post('/sign-up', [UserController::class, 'store']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::group(["prefix" => "patient", "middleware" => ["auth", "isPatient"], "as" => "patient."], function () {
    Route::view('/', 'patient.chat');
    Route::view('/schedules', 'patient.schedules');
    Route::view('/settings', 'patient.settings');
});

Route::group(["prefix" => "doctor", "middleware" => ["auth", "isDoctor"], "as" => "doctor."], function () {
    Route::view('/', 'doctor.schedules');
    Route::view('/settings', 'doctor.settings');
});

Route::group(["prefix" => "admin", "middleware" => ["auth", "isAdmin"], "as" => "admin."], function () {
    Route::resource('/', AdminController::class)->only('index', 'store');
    Route::get('/admins/{id}', [AdminController::class, 'destroy']);
    Route::resource('/doctors', DoctorController::class)->only('index', 'store');
    Route::get('/doctors/{id}', [DoctorController::class, 'destroy']);
    Route::view('/settings', 'admin.settings');
    Route::post('/settings', [AdminController::class, 'update']);
});
