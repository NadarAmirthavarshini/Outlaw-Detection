<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SuspectController;
use App\Http\Controllers\AirportController;
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

require __DIR__.'/auth.php';

Route::get('/login', [LoginController::class, 'login']);
Route::post('/auth', [LoginController::class, 'auth']);
Route::get('/logout', [LoginController::class, 'logout']);

Route::middleware('auth.session')->group(function () {
Route::get('/all-admin',[AdminController::class, 'allAdmin']);
Route::get('/add-admin',[AdminController::class, 'addAdmin']);
Route::post('/store-admin',[AdminController::class, 'storeAdmin']);
Route::get('/edit-admin/{id}', [AdminController::class, 'editAdmin']);
Route::post('/update-admin', [AdminController::class, 'updateAdmin']);
Route::get('/delete-admin/{id}', [AdminController::class, 'deleteAdmin']);

Route::get('/all-suspect',[SuspectController::class, 'allSuspect']);
Route::get('/add-suspect',[SuspectController::class, 'addSuspect']);
Route::post('/get-city',[SuspectController::class, 'getCity']);
Route::post('/store-suspect',[SuspectController::class, 'storeSuspect']);
Route::get('/view-suspect/{id}', [SuspectController::class, 'viewSuspect']);
Route::get('/edit-suspect/{id}', [SuspectController::class, 'editSuspect']);
Route::post('/update-suspect', [SuspectController::class, 'updateSuspect']);
Route::get('/delete-suspect/{id}', [SuspectController::class, 'deleteSuspect']);


Route::get('/all-airport',[AirportController::class, 'allAirport']);
Route::get('/add-airport',[AirportController::class, 'addAirport']);
Route::post('/store-airport',[AirportController::class, 'storeAirport']);
Route::get('/status-airport/{id}',[AirportController::class, 'statusAirport']);
Route::get('/edit-airport/{id}', [AirportController::class, 'editAirport']);
Route::post('/update-airport', [AirportController::class, 'updateAirport']);

Route::get('/all-device',[AirportController::class, 'allDevice']);
Route::get('/add-device',[AirportController::class, 'addDevice']);
Route::post('/store-device',[AirportController::class, 'storeDevice']);
Route::get('/status-device/{id}',[AirportController::class, 'statusDevice']);

Route::get('/notification',[SuspectController::class, 'notification']);
Route::get('/get-notification',[SuspectController::class, 'getNotification']);
});
