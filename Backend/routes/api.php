<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\Staff\StaffController;
use App\Http\Controllers\Roles\RoleController;
use App\Http\Controllers\Roles\UserController;
use App\Http\Controllers\Rooms\RoomTypesController;
use App\Http\Controllers\Rooms\RoomController;

/** Staff Route */
Route::get('staff',     [StaffController::class,'staff']);

/* Auth Route */
Route::post('register', [UserAuthController::class, 'register']);
Route::post('login',    [UserAuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {

    /*
        Here You can Write your auth route
    */
    Route::post('logout',    [UserAuthController::class, 'logout']);


    /** Roles Route */
        Route::get   ('roles',            [RoleController::class, 'index'])   ->middleware('permission:role-list');
        Route::post  ('roles/create',     [RoleController::class, 'store'])   ->middleware('permission:role-create');
        Route::get   ('roles/{id}',       [RoleController::class, 'show'])    ->middleware('permission:role-show');
        Route::put   ('roles/{id}',       [RoleController::class, 'update'])  ->middleware('permission:role-edit');
        Route::delete('roles/{id}',       [RoleController::class, 'destroy']) ->middleware('permission:role-delete');

    /** User Route */
        Route::get   ('users',            [UserController::class, 'index'])   ->middleware('permission:user-list');
        Route::post  ('users/create',     [UserController::class, 'store'])   ->middleware('permission:user-create');
        Route::get   ('users/{id}',       [UserController::class, 'show'])    ->middleware('permission:user-show');
        Route::put   ('users/{id}',       [UserController::class, 'update'])  ->middleware('permission:user-edit');
        Route::delete('users/{id}',       [UserController::class, 'destroy']) ->middleware('permission:user-delete');

    /** Room Type Route */
        Route::get       ('room-types',       [RoomTypesController::class, 'index'])   ->middleware('permission:room-type-list');
        Route::post      ('room-types/create',[RoomTypesController::class, 'store'])   ->middleware('permission:room-type-create');
        Route::get       ('room-types/{id}',  [RoomTypesController::class, 'show'])    ->middleware('permission:room-type-show');
        Route::put       ('room-types/{id}',  [RoomTypesController::class, 'update'])  ->middleware('permission:room-type-edit');
        Route::delete    ('room-types/{id}',  [RoomTypesController::class, 'destroy']) ->middleware('permission:room-type-delete');

    /** Room Route */
        Route::get       ('room',             [RoomController::class, 'index'])   ->middleware('permission:room-list');
        Route::post      ('room/create',      [RoomController::class, 'store'])   ->middleware('permission:room-create');
        Route::get       ('room/{id}',        [RoomController::class, 'show'])    ->middleware('permission:room-show');
        Route::put       ('room/{id}',        [RoomController::class, 'update'])  ->middleware('permission:room-edit');
        Route::delete    ('room/{id}',        [RoomController::class, 'destroy']) ->middleware('permission:room-delete');

});
