<?php

use Illuminate\Support\Facades\Route;
use Modules\Letter\App\Http\Controllers\LetterController;

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

Route::middleware(['json.response'])->prefix('v1')->name('api.')->group(function () {
    Route::middleware(['auth:api', 'is-admin'])->group(function () {
        Route::resource('letters', LetterController::class)->except('create', 'edit');
        Route::post('/letters/search', [LetterController::class, 'search'])->name('articles.search');

    });
});
