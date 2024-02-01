<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Authentication\App\Http\Controllers\AuthenticationController;

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

Route::middleware(['json.response'])->prefix('v1/authentication')->name('api.authentication.')->group(function () {
    Route::post('/register', [AuthenticationController::class, 'register'])->name('register');
    Route::post('/login', [AuthenticationController::class, 'login'])->name('login');

    Route::middleware(['auth:api'])->group(function () {
        Route::get('/get/user/data', [AuthenticationController::class, 'getUserData'])->name('user.data');
    });
});

//Route::middleware(['auth:sanctum'])->prefix('v1/authentication')->name('api.')->group(function () {
//    Route::get('authentication', fn (Request $request) => $request->user())->name('authentication');
//});
