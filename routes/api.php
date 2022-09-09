<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;

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

Route::prefix("v2")->group(function(){
  Route::post('/auth/login', [AuthController::class, 'login']);
  Route::post('/auth/request-otp', [AuthController::class, 'request_otp']);
  Route::post('/auth/verify-otp', [AuthController::class, 'verify_otp']);
  // Route::group(['middleware' => 'auth:api'], function () {
  Route::post('/auth/reset-password', [UserController::class, 'resetPassword']);
  // });
});
