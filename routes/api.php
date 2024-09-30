<?php


use App\Http\Controllers\admin\membership\CityController;
use App\Http\Controllers\admin\membership\CourtBranchController;
use App\Http\Controllers\admin\membership\DocumentController;
use App\Http\Controllers\admin\membership\JudgesController;
use App\Http\Controllers\admin\membership\LawyerController;
use App\Http\Controllers\admin\membership\OrganizationalPostController;
use App\Http\Controllers\admin\membership\OrganizationController;
use App\Http\Controllers\admin\membership\PetitionController;
use App\Http\Controllers\admin\membership\SelectController;
use App\Http\Controllers\admin\membership\UserController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

// Landing
Route::get('/landing', LandingController::class);

// Auth
Route::prefix('/auth')->controller(AuthController::class)->group(function () {
    Route::post('/login', 'login')->middleware('guest');

    Route::post('/logout', 'logout')->middleware('auth:sanctum');
});

// Admin
Route::prefix('/admin')->middleware('auth:sanctum')->group(function () {
    // Select
    Route::prefix('/select')->controller(SelectController::class)->group(function () {
        Route::get('/organization', 'organization');
    });

    // Membership
    Route::prefix('/membership')->group(function () {
        // Dashboard
//        Route::get('/dashboard', DashboardController::class);

        // Role
        Route::prefix('/role')->controller(RoleController::class)->group(function () {
            Route::get('/', 'index');
            Route::post('store', 'store');
            Route::get('/show/{role}', 'show');
            Route::put('/update/{role}', 'update');
            Route::delete('/destroy/{role}', 'destroy');
            Route::get('/upsertData', 'upsertData');
        });

        // Permission
        Route::prefix('/permission')->controller(PermissionController::class)->group(function () {
            Route::get('/', 'index');
        });

        // Organization
        Route::prefix('/organization')->controller(OrganizationController::class)->group(function () {
            Route::get('/', 'index');
            Route::post('/store', 'store');
            Route::get('/show/{organization}', 'show');
            Route::put('/update/{organization}', 'update');
            Route::delete('/destroy/{organization}', 'destroy');
            Route::get('/upsertData', 'upsertData');
        });

        // User
        Route::prefix('/user')->controller(UserController::class)->group(function () {
            Route::get('/', 'index');
            Route::post('/store', 'store');
            Route::get('/show/{user}', 'show');
            Route::put('/update/{user}', 'update');
            Route::delete('/destroy/{user}', 'destroy');
            Route::get('/upsertData', 'upsertData');
        });

        // City
        Route::prefix('/city')->controller(CityController::class)->group(function () {
            Route::get('/', 'index');
            Route::post('/store', 'store');
            Route::get('/show/{city}', 'show');
            Route::put('/update/{city}', 'update');
            Route::delete('/destroy/{city}', 'destroy');
            Route::get('/upsertData', 'upsertData');
        });

        // Organizational Post
        Route::prefix('/organizationalPost')->controller(OrganizationalPostController::class)->group(function () {
            Route::get('/', 'index');
            Route::post('/store', 'store');
            Route::get('/show/{organizationalPost}', 'show');
            Route::put('/update/{organizationalPost}', 'update');
            Route::delete('/destroy/{organizationalPost}', 'destroy');
        });

        // Court Branch
        Route::prefix('/courtBranch')->controller(CourtBranchController::class)->group(function () {
            Route::get('/', 'index');
            Route::post('/store', 'store');
            Route::get('/show/{courtBranch}', 'show');
            Route::put('/update/{courtBranch}', 'update');
            Route::delete('/destroy/{courtBranch}', 'destroy');
            Route::get('/upsertData', 'upsertData');
        });

        // Judges
        Route::prefix('/judges')->controller(JudgesController::class)->group(function () {
            Route::get('/', 'index');
            Route::post('/store', 'store');
            Route::get('/show/{judges}', 'show');
            Route::put('/update/{judges}', 'update');
            Route::delete('/destroy/{judges}', 'destroy');
            Route::get('/upsertData', 'upsertData');
        });

        // Lawyer
        Route::prefix('/lawyer')->controller(LawyerController::class)->group(function () {
            Route::get('/', 'index');
            Route::post('/store', 'store');
            Route::get('/show/{lawyer}', 'show');
            Route::put('/update/{lawyer}', 'update');
            Route::delete('/destroy/{lawyer}', 'destroy');
            Route::get('/upsertData', 'upsertData');
        });

        // Document
        Route::prefix('/document')->controller(DocumentController::class)->group(function () {
            Route::get('/', 'index');
            Route::post('/store', 'store');
            Route::get('/show/{document}', 'show');
            Route::put('/update/{document}', 'update');
            Route::delete('/destroy/{document}', 'destroy');
            Route::get('/upsertData', 'upsertData');
        });

        // Petition
        Route::prefix('/petition')->controller(PetitionController::class)->group(function () {
            Route::get('/{document}/index', 'index');
            Route::post('/store', 'store');
            Route::get('/{document}/show/{petition}', 'show');
            Route::put('/update/{petition}', 'update');
            Route::delete('/destroy/{petition}', 'destroy');
            Route::get('/upsertData', 'upsertData');
        });

    });
});
