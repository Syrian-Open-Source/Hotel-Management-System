<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\Staff\StaffController;
use App\Http\Controllers\Roles\RoleController;
use App\Http\Controllers\Roles\UserController;
use App\Http\Controllers\Rooms\RoomTypesController;
use App\Http\Controllers\Rooms\RoomController;
use App\Http\Controllers\Booking\BookingController;
use App\Http\Controllers\Booking\CheckController;
use App\Http\Controllers\Review\ReviewController;
use App\Http\Controllers\Review\RateController;

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

    /** Booking Route */
        Route::get       ('booking',          [BookingController::class, 'index'])   ->middleware('permission:booking-list');
        Route::get       ('booking/me',       [BookingController::class, 'my_booking']);
        Route::post      ('booking/create',   [BookingController::class, 'store'])   ->middleware('permission:booking-create');
        Route::get       ('booking/{id}',     [BookingController::class, 'show'])    ->middleware('permission:booking-show');
        Route::put       ('booking/{id}',     [BookingController::class, 'update'])  ->middleware('permission:booking-edit');
        Route::delete    ('booking/{id}',     [BookingController::class, 'destroy']) ->middleware('permission:booking-delete');

    /** Check Route */
        Route::post      ('Check',            [CheckController::class, 'store']);

    /** Review Route */
        Route::get       ('review',           [ReviewController::class, 'index'])   ->middleware('permission:review-list');
        Route::get       ('review/me',        [ReviewController::class, 'my_review']);
        Route::post      ('review/create',    [ReviewController::class, 'store'])   ->middleware('permission:review-create');
        Route::get       ('review/{id}',      [ReviewController::class, 'show'])    ->middleware('permission:review-show');
        Route::put       ('review/{id}',      [ReviewController::class, 'update'])  ->middleware('permission:review-edit');
        Route::delete    ('review/{id}',      [ReviewController::class, 'destroy']) ->middleware('permission:review-delete');

    /** Review Route */
        Route::get       ('rate',             [RateController::class, 'index'])   ->middleware('permission:rate-list');
        Route::get       ('rate/me',          [RateController::class, 'my_rate']);
        Route::post      ('rate/create',      [RateController::class, 'store'])   ->middleware('permission:rate-create');
        Route::get       ('rate/{id}',        [RateController::class, 'show'])    ->middleware('permission:rate-show');
        Route::put       ('rate/{id}',        [RateController::class, 'update'])  ->middleware('permission:rate-edit');
        Route::delete    ('rate/{id}',        [RateController::class, 'destroy']) ->middleware('permission:rate-delete');

});
