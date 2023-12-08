<?php

use App\Http\Controllers\Admin\CertificationsController;
use App\Http\Controllers\Admin\CommandsController;
use App\Http\Controllers\Admin\DepartmentsController;
use App\Http\Controllers\Admin\DeploymentsController;
use App\Http\Controllers\Admin\DesignationsController;
use App\Http\Controllers\Admin\DisciplinesController;
use App\Http\Controllers\Admin\DivisionsController;
use App\Http\Controllers\Admin\EmployeesController;
use App\Http\Controllers\Admin\LeavesController;
use App\Http\Controllers\Admin\LeaveTypesController;
use App\Http\Controllers\Admin\OfficeController;
use App\Http\Controllers\Admin\PromotionsController;
use App\Http\Controllers\Admin\QualificationsController;
use App\Http\Controllers\Admin\RanksController;
use App\Http\Controllers\Admin\TrainingListsController;
use App\Http\Controllers\Admin\TrainingsController;
use App\Http\Controllers\Admin\TransfersController;
use App\Http\Controllers\Admin\UnitsController;
use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Admin\ApplicantsController;
use App\Http\Controllers\Admin\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth/login');
});

Route::controller(LoginRegisterController::class)->group(function() {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::get('forgot-password', 'forgotpassword')->name('forgot-password');
    Route::post('forget-password', 'submitForgotPasswordForm')->name('forgot.password.post');
    Route::get('reset-password/{token}', 'showResetPasswordForm')->name('reset.password.get');
    Route::post('reset-password', 'submitResetPasswordForm')->name('reset.password.post');
    Route::post('/logout', 'logout')->name('logout');
});

// Define Custom Verification Routes
Route::controller(VerificationController::class)->group(function() {
    Route::get('/email/verify', 'notice')->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', 'verify')->name('verification.verify');
    Route::post('/email/resend', 'resend')->name('verification.resend');
});

Route::controller(AuthController::class)->group(function() {
    Route::get('/adduser', 'adduser')->name('add-user');
    Route::post('/storeuser', 'store')->name('store-user');
    Route::get('admin/login', 'login')->name('admin/login');
    Route::post('admin/authenticate', 'authenticate')->name('admin/authenticate');
    Route::get('/dashboard', 'dashboard')->name('dashboard');
    Route::get('admin-forgot-password', 'forgotpassword')->name('admin-forgot-password');
    Route::post('admin-forget-password', 'submitForgotPasswordForm')->name('admin-forgot.password.post');
    Route::get('admin-reset-password/{token}', 'showResetPasswordForm')->name('admin-reset.password.get');
    Route::post('admin-reset-password', 'submitResetPasswordForm')->name('admin-reset.password.post');
    Route::post('/logout', 'logout')->name('logout');
});

Route::resource('admin/applicants', ApplicantsController::class);

//commands
Route::get('commands', [CommandsController::class, 'index'])->name('commands.index');
Route::get('commands-create', [CommandsController::class, 'create'])->name('commands-create');
Route::post('commands-edit', [CommandsController::class, 'edit'])->name('commands-edit');
Route::post('commands-store', [CommandsController::class, 'store'])->name('commands-store');
Route::post('commands-delete', [CommandsController::class, 'destroy'])->name('commands-delete');

//offices
Route::get('offices', [OfficeController::class, 'index'])->name('offices.index');
Route::get('offices-create', [OfficeController::class, 'create'])->name('offices-create');
Route::post('offices-edit', [OfficeController::class, 'edit'])->name('offices-edit');
Route::post('offices-store', [OfficeController::class, 'store'])->name('offices-store');
Route::post('offices-delete', [OfficeController::class, 'destroy'])->name('offices-delete');

//offices
Route::get('departments', [DepartmentsController::class, 'index'])->name('departments.index');
Route::get('departments-create', [DepartmentsController::class, 'create'])->name('departments-create');
Route::post('departments-edit', [DepartmentsController::class, 'edit'])->name('departments-edit');
Route::post('departments-store', [DepartmentsController::class, 'store'])->name('departments-store');
Route::post('departments-delete', [DepartmentsController::class, 'destroy'])->name('departments-delete');

//divisions
Route::get('divisions', [DivisionsController::class, 'index'])->name('divisions.index');
Route::get('divisions-create', [DivisionsController::class, 'create'])->name('divisions-create');
Route::post('divisions-edit', [DivisionsController::class, 'edit'])->name('divisions-edit');
Route::post('divisions-store', [DivisionsController::class, 'store'])->name('divisions-store');
Route::post('divisions-delete', [DivisionsController::class, 'destroy'])->name('divisions-delete');

//units
Route::get('units', [UnitsController::class, 'index'])->name('units.index');
Route::get('units-create', [UnitsController::class, 'create'])->name('units-create');
Route::post('units-edit', [UnitsController::class, 'edit'])->name('units-edit');
Route::post('units-store', [UnitsController::class, 'store'])->name('units-store');
Route::post('units-delete', [UnitsController::class, 'destroy'])->name('units-delete');

//ranks
Route::get('ranks', [RanksController::class, 'index'])->name('ranks.index');
Route::get('ranks-create', [RanksController::class, 'create'])->name('ranks-create');
Route::post('ranks-edit', [RanksController::class, 'edit'])->name('ranks-edit');
Route::post('ranks-store', [RanksController::class, 'store'])->name('ranks-store');
Route::post('ranks-delete', [RanksController::class, 'destroy'])->name('ranks-delete');

//designations
Route::get('designations', [DesignationsController::class, 'index'])->name('designations.index');
Route::get('designations-create', [DesignationsController::class, 'create'])->name('designations-create');
Route::post('designations-edit', [DesignationsController::class, 'edit'])->name('designations-edit');
Route::post('designations-store', [DesignationsController::class, 'store'])->name('designations-store');
Route::post('designations-delete', [DesignationsController::class, 'destroy'])->name('designations-delete');

//commands
Route::get('leavetypes', [LeaveTypesController::class, 'index'])->name('leavetypes.index');
Route::get('leavetypes-create', [LeaveTypesController::class, 'create'])->name('leavetypes-create');
Route::post('leavetypes-edit', [LeaveTypesController::class, 'edit'])->name('leavetypes-edit');
Route::post('leavetypes-store', [LeaveTypesController::class, 'store'])->name('leavetypes-store');
Route::post('leavetypes-delete', [LeaveTypesController::class, 'destroy'])->name('leavetypes-delete');

//deployments
Route::get('deployments', [DeploymentsController::class, 'index'])->name('deployments.index');
Route::get('deployments-create', [DeploymentsController::class, 'create'])->name('deployments-create');
Route::post('deployments-edit', [DeploymentsController::class, 'edit'])->name('deployments-edit');
Route::post('deployments-store', [DeploymentsController::class, 'store'])->name('deployments-store');
Route::post('deployments-delete', [DeploymentsController::class, 'destroy'])->name('deployments-delete');

//promotions
Route::get('promotions', [PromotionsController::class, 'index'])->name('promotions.index');
Route::get('promotions-create', [PromotionsController::class, 'create'])->name('promotions-create');
Route::post('promotions-edit', [PromotionsController::class, 'edit'])->name('promotions-edit');
Route::post('promotions-store', [PromotionsController::class, 'store'])->name('promotions-store');
Route::post('promotions-delete', [PromotionsController::class, 'destroy'])->name('promotions-delete');

//disciplines
Route::get('disciplines', [DisciplinesController::class, 'index'])->name('disciplines.index');
Route::get('disciplines-create', [DisciplinesController::class, 'create'])->name('disciplines-create');
Route::post('disciplines-edit', [DisciplinesController::class, 'edit'])->name('disciplines-edit');
Route::post('disciplines-store', [DisciplinesController::class, 'store'])->name('disciplines-store');
Route::post('disciplines-delete', [DisciplinesController::class, 'destroy'])->name('disciplines-delete');

//Certification
Route::get('certifications', [CertificationsController::class, 'index'])->name('certifications.index');
Route::get('certifications-create', [CertificationsController::class, 'create'])->name('certifications-create');
Route::post('certifications-edit', [CertificationsController::class, 'edit'])->name('certifications-edit');
Route::post('certifications-store', [CertificationsController::class, 'store'])->name('certifications-store');
Route::post('certifications-delete', [CertificationsController::class, 'destroy'])->name('certifications-delete');

//Qualifications
Route::get('qualifications', [QualificationsController::class, 'index'])->name('qualifications.index');
Route::get('qualifications-create', [QualificationsController::class, 'create'])->name('qualifications-create');
Route::post('qualifications-edit', [QualificationsController::class, 'edit'])->name('qualifications-edit');
Route::post('qualifications-store', [QualificationsController::class, 'store'])->name('qualifications-store');
Route::post('qualifications-delete', [QualificationsController::class, 'destroy'])->name('qualifications-delete');

//transfers
Route::get('transfers', [TransfersController::class, 'index'])->name('transfers.index');
Route::get('transfers-create', [TransfersController::class, 'create'])->name('transfers-create');
Route::post('transfers-edit', [TransfersController::class, 'edit'])->name('transfers-edit');
Route::post('transfers-store', [TransfersController::class, 'store'])->name('transfers-store');
Route::post('transfers-delete', [TransfersController::class, 'destroy'])->name('transfers-delete');

//training lists
Route::get('traininglists', [TrainingListsController::class, 'index'])->name('traininglists.index');
Route::get('traininglists-create', [TrainingListsController::class, 'create'])->name('traininglists-create');
Route::post('traininglists-edit', [TrainingListsController::class, 'edit'])->name('traininglists-edit');
Route::post('traininglists-store', [TrainingListsController::class, 'store'])->name('traininglists-store');
Route::post('traininglists-delete', [TrainingListsController::class, 'destroy'])->name('traininglists-delete');

//trainings
Route::get('trainings', [TrainingsController::class, 'index'])->name('trainings.index');
Route::get('trainings-create', [TrainingsController::class, 'create'])->name('trainings-create');
Route::post('trainings-edit', [TrainingsController::class, 'edit'])->name('trainings-edit');
Route::post('trainings-store', [TrainingsController::class, 'store'])->name('trainings-store');
Route::post('trainings-delete', [TrainingsController::class, 'destroy'])->name('trainings-delete');

//employees
Route::resource('employees', EmployeesController::class);
Route::post('fetch-cities', [EmployeesController::class, 'fetchCities']);

//leaves
Route::get('leaves', [LeavesController::class, 'index'])->name('leaves.index');
Route::get('leaves-create', [LeavesController::class, 'create'])->name('leaves-create');
Route::post('leaves-edit', [LeavesController::class, 'edit'])->name('leaves-edit');
Route::get('leaves-handle/{id}', [LeavesController::class, 'handleleave'])->name('leaves-handle');
Route::get('leaves-cancel/{id}', [LeavesController::class, 'cancelleave'])->name('leaves-cancel');

Route::patch('admin/leaves/handlerequest/{id}', [LeavesController::class, 'handlerequest'])->name('leaves.handlerequest');
Route::post('leaves-store', [LeavesController::class, 'store'])->name('leaves-store');
Route::post('leaves-delete', [LeavesController::class, 'destroy'])->name('leaves-delete');
