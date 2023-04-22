<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
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

Route::post('login',[AuthController::class, 'login']);
Route::post('register',[AuthController::class, 'register']);

Route::middleware('auth:sanctum')->post('logout',[AuthController::class, 'logout']);

Route::middleware('auth:sanctum')->group(function() {
    Route::post('profile/update',[AuthController::class, 'profileUpdate']);
    Route::post('personalInfo/update',[AuthController::class, 'personalInfoUpdate']);
    Route::post('account/delete',[AuthController::class, 'AccountDelete']);
});
