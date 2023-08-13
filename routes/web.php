<?php

use App\Http\Controllers\AuthController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::view('/test', 'layout');

Route::view('/', 'index')->name('login');
Route::post('/', [AuthController::class, 'login']);
Route::view('/sign-up', 'sign-up');
Route::post('/sign-up', [UserController::class, 'store']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::group(["prefix" => "patient", "middleware" => ["auth", "isPatient"], "as" => "patient."], function () {
    Route::view('/', 'welcome');
});

Route::group(["prefix" => "doctor", "middleware" => ["auth", "isDoctor"], "as" => "doctor."], function () {
    Route::view('/', 'welcome');
});

Route::group(["prefix" => "admin", "middleware" => ["auth", "isAdmin"], "as" => "admin."], function () {
    Route::view('/', 'welcome');
});
