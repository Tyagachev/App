<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\User\UserController;
use App\Http\Controllers\Api\Generate\GenerateController;
use App\Http\Controllers\Api\Statistics\StatisticsController;
use App\Http\Controllers\Api\Auth\Login\LoginController;
use App\Http\Controllers\Api\Auth\Registration\RegisterController;
use App\Http\Controllers\Api\Auth\Registration\UserVerifiedNumberController;
use App\Http\Controllers\Api\Ticket\TicketController;
use App\Http\Controllers\Api\Auth\Check\CheckController;

Route::post('/register', [RegisterController::class, 'register']);

Route::post('/confirm-verify', [UserVerifiedNumberController::class, 'verify']);

Route::post('/login', [LoginController::class, 'login']);

Route::group(['middleware' => 'auth:sanctum'], function () {

    /**
     * User
     **/
    Route::prefix('user')->group(function () {
        Route::get('/list', [UserController::class, 'index']);
        Route::get('/show/{id}', [UserController::class, 'show']);
        Route::post('/create', [UserController::class, 'store']);
    });


    /**
     * Ticket
     **/
    Route::prefix('ticket')->group(function () {
        Route::get('/list', [TicketController::class, 'index']);
        Route::post('/store', [TicketController::class, 'store']);
        Route::get('/edit', [TicketController::class, 'edit']);
        Route::delete('/destroy/{id}', [TicketController::class, 'destroy']);
    });


    /**
     * Statistics
     **/
    Route::prefix('statistics')->group(function () {
        Route::get('/user-count',[StatisticsController::class, 'getCountUsers']);
    });

    /**
     * Check
     *
     * Контроллер проверки на авторизацию пользователя
     * и получения данных о пользователе
     **/
    Route::prefix('check')->group(function () {
        Route::get('/auth/user', [CheckController::class, 'authUser']);
        Route::get('/auth/checked', [CheckController::class, 'authCheck']);
    });

    /**
     * Generate
     **/
    Route::post('/generate-password', [GenerateController::class, 'create']);
    Route::get('/test/{id}', [\App\Http\Controllers\Api\TestAuthController::class, 'test'])->name('test');
    Route::post('/logout', [LoginController::class, 'logout']);
});

//Auth::routes(['verify' => true]);
