<?php


use App\Http\Controllers\admin\membership\OrganizationController;
use App\Http\Controllers\admin\membership\SelectController;
use App\Http\Controllers\admin\membership\UserController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;

use Illuminate\Support\Facades\Route;

//Auth
Route::prefix('/auth')->controller(AuthController::class)->group(function (){
    Route::post('/login', 'login')->middleware('guest');

    Route::post('/logout', 'logout')->middleware('auth:sanctum');
});


Route::prefix('/admin')/*->middleware('auth:sanctum')*/->group(function () {
    Route::prefix('/membership')->group(function () {

        // Role
        Route::prefix('/role')->controller(RoleController::class)->group(function () {
            Route::get('/', 'index');
            Route::get('/show/{role}', 'show');
            Route::post('store', 'store');
            Route::put('/update/{role}', 'update');
            Route::delete('/destroy/{role}', 'destroy');
            Route::get('/upsertData', 'upsertData');
        });

        // Permission
        Route::prefix('/permission')->controller(PermissionController::class)->group(function () {
            Route::get('/', 'index');
            Route::get('/upsertData', 'upsertData');
        });

        Route::prefix('/select')->controller(SelectController::class)->group(function (){
            Route::get('/organizations', 'organizations');
        });

        Route::prefix('/organization')->controller(OrganizationController::class)->group(function () {
            Route::get('/', 'index');
            Route::get('/show/{organization}', 'show');
            Route::post('/store', 'store');
            Route::put('/update/{organization}', 'update');
            Route::delete('/destroy/{organization}', 'destroy');
            Route::get('/upsertData', 'upsertData');
        });


        Route::prefix('/user')->controller(UserController::class)->group(function () {
            Route::get('/', 'index');
            Route::get('/show/{user}', 'show');
            Route::get('/gender/{userId}', 'getUserGender');
            Route::post('/store', 'store');
            Route::put('/update/{user}', 'update');
            Route::delete('/destroy/{user}', 'destroy');
            Route::get('/upsertData', 'upsertData');
        });

    });
});
