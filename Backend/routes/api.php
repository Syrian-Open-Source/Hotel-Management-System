<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\Staff\StaffController;

/** Staff Route */
Route::get('staff',[StaffController::class,'staff']);

/* Auth Route */
Route::post('register', [UserAuthController::class, 'register']);
Route::post('login', [UserAuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {

    /*
        Here You can Write your auth route
    */

});
