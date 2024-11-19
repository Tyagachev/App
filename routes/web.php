<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TestAuthController;


Auth::routes();

Route::get('/clear', function() {

   Artisan::call('cache:clear');
   Artisan::call('config:clear');
   Artisan::call('config:cache');
   Artisan::call('view:clear');

   return "Cleared!";

});

Route::get('/migrate', function() {
    Artisan::call('migrate',
        [
            '--path' => 'database/migrations',
            '--database' => env('DB_DATABASE'),
            '--force' => true
        ]);

    return "Migrate";
});

Route::get('/test', [TestAuthController::class, 'test']);

Route::get('/migrate/fresh', function() {
    Artisan::call('migrate:fresh');

    return "Freshed";
});

Route::get('{page}', [App\Http\Controllers\IndexController::class, 'index'])->where('page', '.*');
