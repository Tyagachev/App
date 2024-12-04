<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
Route::get('/test2', [TestAuthController::class, 'test2']);

Route::get('/migrate/fresh', function() {
    Artisan::call('migrate:fresh');

    return "Freshed";
});

Route::get('/db', function() {
    try {
        DB::connection()->getPdo();
    } catch (\Exception $e) {
        die("Could not connect to the database.  Please check your configuration. error:" . $e );
    }
});

Route::get('{page}', [App\Http\Controllers\IndexController::class, 'index'])->where('page', '.*');
