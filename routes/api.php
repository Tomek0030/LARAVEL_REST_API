<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AppointmentController;
use App\Http\Controllers\Api\BookingController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::apiResource('appointments', AppointmentController::class);
Route::get('/status/unavailable', [AppointmentController::class, 'unavailable_appointments']);

Route::get('/status/available', [BookingController::class, 'index']);
Route::get('/add/appointment/{appointment}/email/{email}', [BookingController::class, 'store']);
Route::get('/remove/appointment/{appointment}/email/{email}', [BookingController::class, 'update']);
