<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\CategoryController;
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

    Route::prefix('brand')->group(function () {
        Route::post('/',[BrandController::class, 'index']);
        Route::post('create',[BrandController::class,'create']);
        Route::post('update',[BrandController::class,'update']);
        Route::post('delete',[BrandController::class,'delete']);
        Route::post('restore',[BrandController::class,'restore']);

    });

    Route::prefix('category')->group(function () {
        Route::post('/',[CategoryController::class, 'index']);
        Route::post('create',[CategoryController::class,'create']);
        Route::post('update',[CategoryController::class,'update']);
        Route::post('delete',[CategoryController::class,'delete']);
        Route::post('restore',[CategoryController::class,'restore']);

    });
});
