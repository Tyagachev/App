<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\User\UserController;
use App\Http\Controllers\Api\Generate\GenerateController;
use App\Http\Controllers\Api\Statistics\StatisticsController;


use App\Http\Controllers\Api\Ticket\TicketController;
use App\Http\Controllers\Api\Answer\AnswerController;
use App\Http\Controllers\Api\Auth\Check\CheckController;

Route::group(['middleware' => 'logged:sanctum'], function () {

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
        Route::get('/edit/{id}', [TicketController::class, 'edit']);
        Route::post('/update', [TicketController::class, 'update']);
        Route::delete('/destroy/{id}', [TicketController::class, 'destroy']);
    });

    /**
     * Answer
     **/
    Route::prefix('answer')->group(function () {
        Route::delete('/destroy/{id}', [AnswerController::class, 'destroy']);
    });

    /**
     * Statistics
     **/
    Route::prefix('statistics')->group(function () {
        Route::get('/user-count',[StatisticsController::class, 'getCountUsers']);
        Route::get('/ticket-count',[StatisticsController::class, 'getCountTickets']);
    });

    /**
     * Check
     *
     * Контроллер проверки на авторизацию пользователя
     * и получения данных о пользователе
     **/
    Route::prefix('check')->group(function () {
        Route::get('/auth/user', [CheckController::class, 'authUser']);
        Route::get('/logged/checked', [CheckController::class, 'authCheck']);
    });

    /**
     * Generate
     **/
    Route::post('/generate-password', [GenerateController::class, 'create']);
    Route::get('/test/{id}', [\App\Http\Controllers\Api\TestAuthController::class, 'test'])->name('test');

});

require_once (__DIR__ . '/auth.php');

//Auth::routes(['verify' => true]);
