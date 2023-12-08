<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => 'auth',
], function ()  {
    Route::controller(AuthController::class)->group(function () {
        Route::post('/login', 'login');
        Route::post('/register', 'register');
        Route::post('/reset-password', 'resetPassword');
        Route::post('/update-password', 'updatePassword');
    });
});

Route::group(
    [
        'middleware' => 'auth:sanctum',
    ],
    function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

        Route::prefix('admin')->group(function () {
            Route::get('verify-nin/{applicant_id}', [ApplicantController::class, 'adminVerifyNIN']);

            Route::post('cbt-invitation', [ApplicantController::class, 'CBTInvitation']);

            Route::post('physical-verification', [ApplicantController::class, 'physicalVerification']);

            Route::get('application-completed/{applicant_id}', [ApplicantController::class, 'applicationCompleted']);

            Route::apiResource('shortlisted-applicant', App\Http\Controllers\ShortlistedApplicantController::class);
        });

        // admin
        Route::apiResource('office', App\Http\Controllers\OfficeController::class);

        Route::apiResource('department', App\Http\Controllers\DepartmentController::class);

        Route::apiResource('division', App\Http\Controllers\DivisionController::class);

        Route::apiResource('unit', App\Http\Controllers\UnitController::class);

        Route::apiResource('designation', App\Http\Controllers\DesignationController::class);

        Route::apiResource('employee', App\Http\Controllers\EmployeeController::class);

        Route::apiResource('work-history', App\Http\Controllers\WorkHistoryController::class);

        Route::apiResource('emp-qualification', App\Http\Controllers\EmpQualificationController::class);

        Route::apiResource('emp-certification', App\Http\Controllers\EmpCertificationController::class);

        Route::apiResource('promotion', App\Http\Controllers\PromotionController::class);

        Route::apiResource('deployment', App\Http\Controllers\DeploymentController::class);

        Route::apiResource('transfer', App\Http\Controllers\TransferController::class);

        Route::apiResource('training', App\Http\Controllers\TrainingController::class);

        Route::apiResource('leave-type', App\Http\Controllers\LeaveTypeController::class);

        Route::apiResource('leave', App\Http\Controllers\LeaveController::class);

        Route::apiResource('discipline', App\Http\Controllers\DisciplineController::class);
        // end admin

        Route::apiResource('applicant', App\Http\Controllers\ApplicantController::class);

        Route::apiResource('work-experience', App\Http\Controllers\WorkExperienceController::class);

        Route::apiResource('qualification', App\Http\Controllers\QualificationController::class);

        Route::apiResource('certification', App\Http\Controllers\CertificationController::class);

        Route::apiResource('reference', App\Http\Controllers\ReferenceController::class);

        Route::apiResource('job-position', App\Http\Controllers\JobPositionController::class);

        Route::apiResource('job-application', App\Http\Controllers\JobApplicationController::class);

        Route::apiResource('user-role', App\Http\Controllers\UserRoleController::class);

        Route::apiResource('geo-state', App\Http\Controllers\GeoStateController::class);

        Route::apiResource('geo-lga', App\Http\Controllers\GeoLgaController::class);

        Route::post('submit-application', [ApplicantController::class, 'submitApplication']);

        Route::get('verify-nin/{nin}', [ApplicantController::class, 'verifyNIN']);

        Route::apiResource('interview-criteria', App\Http\Controllers\InterviewCriteriaController::class);

        Route::apiResource('interview-result', App\Http\Controllers\InterviewResultController::class);
    }
);
