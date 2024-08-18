<?php

use App\Http\Controllers\Api\Auth\Login\LoginController;
use App\Http\Controllers\Api\Auth\Registration\RegisterController;
use App\Http\Controllers\Api\Auth\Registration\UserVerifiedNumberController;
use Illuminate\Support\Facades\Route;

//Auth::routes(['verify' => true]);

Route::post('/register', [RegisterController::class, 'register']);

Route::post('/confirm-verify', [UserVerifiedNumberController::class, 'verify']);

Route::post('/login', [LoginController::class, 'login']);

//Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/test/{id}', [\App\Http\Controllers\Api\TestAuthController::class, 'test'])->name('test');
//});

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('/logout', [LoginController::class, 'logout']);
});

