<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group([
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', [EmployeeController::class, 'login']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('logout', [EmployeeController::class, 'logout']);
    Route::post('refresh', [EmployeeController::class, 'refresh']);
    Route::post('me', [EmployeeController::class, 'me']);
});
