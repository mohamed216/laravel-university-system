<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\OnlineLectureController;

// Public Routes
Route::get('/', function () {
    return redirect('/login');
});

// Language Routes
Route::get('/language/{locale}', [LanguageController::class, 'setLocale'])->name('language.switch');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes (require authentication)
Route::middleware(['auth'])->group(function () {
    // Dashboard - accessible to all authenticated users
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Reports - Admin only
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
        Route::get('/reports/students', [ReportController::class, 'students'])->name('reports.students');
        Route::get('/reports/enrollments', [ReportController::class, 'enrollments'])->name('reports.enrollments');
        Route::get('/reports/payments', [ReportController::class, 'payments'])->name('reports.payments');
        Route::get('/reports/grades', [ReportController::class, 'grades'])->name('reports.grades');
        Route::get('/reports/finance', [ReportController::class, 'finance'])->name('reports.finance');
    });
    
    // Activity Log - Admin only
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/activities', [ActivityController::class, 'index'])->name('activities.index');
        Route::get('/activities/{activity}', [ActivityController::class, 'show'])->name('activities.show');
    });
    
    // My Activity - All authenticated users
    Route::get('/my-activity', [ActivityController::class, 'userActivity'])->name('activities.user');
    
    // Settings - Admin only
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
        Route::post('/settings', [SettingsController::class, 'update'])->name('settings.update');
        Route::post('/settings/logo', [SettingsController::class, 'logo'])->name('settings.logo');
        Route::get('/settings/reset', [SettingsController::class, 'reset'])->name('settings.reset');
    });
    
    // Admin only routes
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('faculties', FacultyController::class);
        Route::resource('departments', DepartmentController::class);
        Route::resource('students', StudentController::class);
        Route::resource('professors', ProfessorController::class);
        Route::resource('fees', FeeController::class);
    });
    
    // Courses (Admin + Professors)
    Route::middleware(['role:admin,professor'])->group(function () {
        Route::resource('courses', CourseController::class);
        Route::resource('enrollments', EnrollmentController::class);
        Route::post('/enrollments/approve/{enrollment}', [EnrollmentController::class, 'approve'])->name('enrollments.approve');
        Route::post('/enrollments/drop/{enrollment}', [EnrollmentController::class, 'drop'])->name('enrollments.drop');
        Route::resource('grades', GradeController::class);
        Route::post('/grades/submit', [GradeController::class, 'submit'])->name('grades.submit');
        Route::resource('attendances', AttendanceController::class);
        Route::post('/attendances/mark', [AttendanceController::class, 'mark'])->name('attendances.mark');
    });
    
    // Finance (Admin only)
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('payments', PaymentController::class);
        Route::get('/payments/receipt/{payment}', [PaymentController::class, 'receipt'])->name('payments.receipt');
    });
    
    // Library - accessible to all
    Route::resource('library', LibraryController::class);
    Route::post('/library/borrow', [LibraryController::class, 'borrow'])->name('library.borrow');
    Route::post('/library/return', [LibraryController::class, 'returnBook'])->name('library.return');
});


// Online Lectures Routes
Route::middleware(['role:admin,professor'])->group(function () {
    Route::resource('online-lectures', OnlineLectureController::class);
    Route::post('/online-lectures/{onlineLecture}/start', [OnlineLectureController::class, 'startLive'])->name('online-lectures.start');
    Route::post('/online-lectures/{onlineLecture}/end', [OnlineLectureController::class, 'endLive'])->name('online-lectures.end');
});

// Student Online Lectures (view only)
Route::middleware(['auth'])->group(function () {
    Route::get('/my-lectures', [OnlineLectureController::class, 'myLectures'])->name('online-lectures.my');
});
