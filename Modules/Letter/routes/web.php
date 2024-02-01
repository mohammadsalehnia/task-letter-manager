<?php

use Illuminate\Support\Facades\Route;
use Modules\Letter\App\Http\Controllers\Panel\LetterController;

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

Route::middleware(['auth:web','is-admin'])->prefix('panel')->name('panel.')->group(function () {
    Route::resource('letters', LetterController::class)->names('letter');

});
