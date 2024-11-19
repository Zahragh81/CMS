<?php


use App\Http\Controllers\admin\membership\AnswerController;
use App\Http\Controllers\admin\membership\CityController;
use App\Http\Controllers\admin\membership\CourtBranchController;
use App\Http\Controllers\admin\membership\DashboardController;
use App\Http\Controllers\admin\membership\DataFormController;
use App\Http\Controllers\admin\membership\DocumentController;
use App\Http\Controllers\admin\membership\FormController;
use App\Http\Controllers\admin\membership\JudgesController;
use App\Http\Controllers\admin\membership\LawyerController;
use App\Http\Controllers\admin\membership\MeetingController;
use App\Http\Controllers\admin\membership\OrganizationalPostController;
use App\Http\Controllers\admin\membership\OrganizationController;
use App\Http\Controllers\admin\membership\PetitionController;
use App\Http\Controllers\admin\membership\ProtestationController;
use App\Http\Controllers\admin\membership\QuestionController;
use App\Http\Controllers\admin\membership\RulingController;
use App\Http\Controllers\admin\membership\SelectController;
use App\Http\Controllers\admin\membership\SurveryController;
use App\Http\Controllers\admin\membership\SurveyController;
use App\Http\Controllers\admin\membership\TicketActionController;
use App\Http\Controllers\admin\membership\TicketController;
use App\Http\Controllers\admin\membership\UnitSelectionController;
use App\Http\Controllers\admin\membership\UserController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Models\membership\SmsNotification;
use App\Models\membership\SmsNotificationRecipient;
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
            Route::get('/closedIndex', 'closedIndex');
            Route::get('/stagnantIndex', 'stagnantIndex');
            Route::post('/store', 'store');
            Route::get('/show/{document}', 'show');
            Route::put('/update/{document}', 'update');
            Route::delete('/destroy/{document}', 'destroy');
            Route::get('/upsertData', 'upsertData');
            Route::put('/changeStatus/{document}', 'changeStatus');

            // Petition
            Route::prefix('/{document}/petition')->controller(PetitionController::class)->group(function () {
                Route::get('/', 'index');
                Route::post('/store', 'store');
                Route::get('/show/{petition}', 'show');
                Route::put('/update/{petition}', 'update');
                Route::delete('/destroy/{petition}', 'destroy');
            });

            // Ruling
            Route::prefix('/{document}/ruling')->controller(RulingController::class)->group(function () {
                Route::get('/', 'index');
                Route::post('/store', 'store');
                Route::get('/show/{ruling}', 'show');
                Route::put('/update/{ruling}', 'update');
                Route::delete('/destroy/{ruling}', 'destroy');
                Route::get('/upsertData', 'upsertData');
            });

            // Protestation
            Route::prefix('/{document}/protestation')->controller(ProtestationController::class)->group(function () {
                Route::get('/', 'index');
                Route::post('/store', 'store');
                Route::get('/show/{protestation}', 'show');
                Route::put('/update/{protestation}', 'update');
                Route::delete('/destroy/{protestation}', 'destroy');
                Route::get('/upsertData', 'upsertData');
            });

            // Meeting
            Route::prefix('/{document}/meeting')->controller(MeetingController::class)->group(function () {
                Route::get('/', 'index');
                Route::post('/store', 'store');
                Route::get('/show/{meeting}', 'show');
                Route::put('/update/{meeting}', 'update');
                Route::delete('/destroy/{meeting}', 'destroy');
                Route::get('/{meeting}/smsNotification', 'smsNotification');
                Route::get('/upsertData', 'upsertData');
            });
        });

        // Calendar
        Route::get('/calendar', [MeetingController::class, 'calendar']);

        // Ticket
        Route::prefix('/ticket')->controller(TicketController::class)->group(function () {
            Route::get('/', 'index');
            Route::post('/store', 'store');
            Route::get('/show/{ticket}', 'show');
            Route::put('/changeStatus/{ticket}', 'changeStatus');
            Route::get('/upsertData', 'upsertData');

            // TicketAction
            Route::prefix('/{ticket}/ticketAction')->controller(TicketActionController::class)->group(function () {
                Route::get('/', 'index');
                Route::post('/store', 'store');
                Route::get('/show/{ticketAction}', 'show');
                Route::put('/update/{ticketAction}', 'update');
                Route::post('/organizationUser', 'organizationUser');
                Route::get('/upsertData', 'upsertData');
            });
        });

        // TicketAction
        Route::prefix('/ticketAction')->controller(TicketActionController::class)->group(function () {
            Route::put('/changeStatus/{ticketAction}', 'changeStatusTicketAction');
            Route::get('/upsertData', 'upsertData');
        });

        // Dashboard
        Route::prefix('/dashboard')->controller(DashboardController::class)->group(function () {
            Route::get('/ticketPerYear', 'ticketPerYear');
            Route::get('/ticketStatus', 'ticketStatus');
            Route::get('/indexByLowestProgress', 'indexByLowestProgress');
            Route::get('/ticketGroup', 'ticketGroup');
            Route::get('/upsertData', 'upsertData');
            Route::get('/ticketActionCountByOrganization', 'ticketActionCountByOrganization');
            Route::post('/ticketActionCountByOrganizationAndMonth', 'ticketActionCountByOrganizationAndMonth');
            Route::get('/topOrganizationsByTicketAction', 'topOrganizationsByTicketAction');
            Route::get('/topReferralExpert', 'topReferralExpert');
            Route::get('/topTicketByReferral', 'topTicketByReferral');
        });

        // Form
        Route::prefix('/form')->controller(FormController::class)->group(function () {
            Route::get('/', 'index');
            Route::post('/store', 'store');
            Route::get('/show/{form}', 'show');
            Route::put('/update/{form}', 'update');
            Route::delete('/destroy/{form}', 'destroy');

            // Question
            Route::prefix('/{form}/question')->controller(QuestionController::class)->group(function () {
                Route::get('/', 'index');
                Route::post('/store', 'store');
                Route::get('/show/{question}', 'show');
                Route::put('/update/{question}', 'update');
                Route::delete('/destroy/{question}', 'destroy');
            });

            // Answer
            Route::prefix('/{form}/answer')->controller(AnswerController::class)->group(function () {
                Route::get('/', 'index');
                Route::post('/store', 'store');
                Route::get('/show/{answer}', 'show');
                Route::put('/update/{answer}', 'update');
                Route::delete('/destroy/{answer}', 'destroy');
            });
        });

        // UnitSelection
        Route::prefix('/unitSelection')->controller(UnitSelectionController::class)->group(function () {
            Route::get('/', 'index');
            Route::post('/store/{unitSelection}', 'store');
            Route::get('/show/{unitSelection}', 'show');
            Route::put('/update/{unitSelection}', 'update');
            Route::get('/answer', 'answer');
            Route::get('/upsertData', 'upsertData');
        });

    });
});
