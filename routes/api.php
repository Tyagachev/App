<?php

use App\Http\Controllers\Api\Auth\Login\LoginController;
use App\Http\Controllers\Api\Auth\Registration\RegisterController;
use App\Http\Controllers\Api\Auth\Registration\UserVerifiedNumberController;
use App\Http\Controllers\Api\Statistics\StatisticsController;
use App\Http\Controllers\Api\User\UserController;
use App\Http\Controllers\Api\Generate\GenerateController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [RegisterController::class, 'register']);

Route::post('/confirm-verify', [UserVerifiedNumberController::class, 'verify']);

Route::post('/login', [LoginController::class, 'login']);

Route::group(['middleware' => 'auth:sanctum'], function () {

    /**
     * User
     **/
    Route::get('/user/{id}', [UserController::class, 'index']);
    Route::get('/user-auth', [UserController::class, 'auth']);
    Route::get('/users-list', [UserController::class, 'getAllUser']);
    Route::post('/user/create', [UserController::class, 'create']);

    /**
     * Statistics
     **/
    Route::get('/statistics/user-count',[StatisticsController::class, 'getCountUsers']);
    /**
     * Generate
     **/
    Route::post('/generate-password', [GenerateController::class, 'create']);
    Route::get('/test/{id}', [\App\Http\Controllers\Api\TestAuthController::class, 'test'])->name('test');
    Route::post('/logout', [LoginController::class, 'logout']);
});

//Auth::routes(['verify' => true]);
