<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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



Route::get('/calendar', 'App\Http\Controllers\AppointmentController@getCalendarView')->name('calendar');
Route::post('/calendar/event/insert', 'App\Http\Controllers\AppointmentController@insertAppointment')->name('addevent');
Route::post('/calendar/event/delete', 'App\Http\Controllers\AppointmentController@deleteAppointment')->name('deleteevent');
Route::post('/calendar/event/update', 'App\Http\Controllers\AppointmentController@updateAppointment')->name('updateevent');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');
Route::middleware(['auth:sanctum', 'verified'])->get('/', function () {
    return Inertia::render('Dashboard');
})->name('home');
