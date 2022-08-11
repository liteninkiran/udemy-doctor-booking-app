<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::get('/', [FrontendController::class, 'index']);
Route::get('/appointment/{doctorId}/{date}', [AppointmentController::class, 'show'])->name('appointment.show');
Route::get('/dashboard', [DashboardController::class, 'index']);
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Admin routes
Route::group(['middleware' => ['auth', 'admin']], function() {
    Route::resource('doctor', DoctorController::class);
});

// Doctor route
Route::group(['middleware' => ['auth', 'doctor']], function() {
    Route::get('/appointment', [AppointmentController::class, 'index'])->name('appointment.index');
    Route::post('/appointment', [AppointmentController::class, 'store'])->name('appointment.store');
    Route::get('/appointment/create', [AppointmentController::class, 'create'])->name('appointment.create');
    Route::post('/appointment/check', [AppointmentController::class, 'check'])->name('appointment.check');
    Route::post('/appointment/update', [AppointmentController::class, 'updateTime'])->name('appointment.update');
});

// Patient routes
Route::group(['middleware' => ['auth', 'patient']], function() {
    Route::post('/book/appointment', [FrontendController::class, 'store'])->name('booking.appointment');
	Route::get('/my-booking', [FrontendController::class, 'myBookings'])->name('my.booking');
});
