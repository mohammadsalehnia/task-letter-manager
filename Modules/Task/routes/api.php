<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Task\App\Http\Controllers\TaskController;

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
    Route::middleware(['auth:api','is-admin'])->group(function () {
        Route::resource('tasks', TaskController::class)->except('create', 'edit');

        Route::patch('/tasks/update/status/{task}', [TaskController::class, 'updateStatus'])
            ->name('tasks.update.status');
    });
});
