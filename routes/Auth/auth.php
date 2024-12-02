<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\Registration\RegisterController;
use App\Http\Controllers\Api\Auth\Registration\UserVerifiedNumberController;
use App\Http\Controllers\Api\Auth\Recover\RecoverController;
use App\Http\Controllers\Api\Auth\Login\LoginController;

Route::post('/register', [RegisterController::class, 'register']);

Route::post('/confirm-verify', [UserVerifiedNumberController::class, 'verify']);
Route::post('/send-code-again', [RegisterController::class, 'sendCodeAgain']);

Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::post('/recovery-password', [RecoverController::class, 'sendResetCode']);
Route::post('/recovery-check', [RecoverController::class, 'checkRecoveryCode']);
Route::post('/reset-password', [RecoverController::class, 'resetPassword']);
