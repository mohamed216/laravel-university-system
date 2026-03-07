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

// Public Routes
Route::get('/', function () {
    return redirect('/login');
});

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes (require authentication)
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Admin only routes
    Route::middleware(['role.admin'])->group(function () {
        Route::resource('faculties', FacultyController::class);
        Route::resource('departments', DepartmentController::class);
        Route::resource('students', StudentController::class);
        Route::resource('professors', ProfessorController::class);
        Route::resource('fees', FeeController::class);
    });
    
    // Courses (Admin + Professors)
    Route::middleware(['role.admin', 'professor'])->group(function () {
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
    Route::middleware(['role.admin'])->group(function () {
        Route::resource('payments', PaymentController::class);
        Route::get('/payments/receipt/{payment}', [PaymentController::class, 'receipt'])->name('payments.receipt');
    });
    
    // Library
    Route::resource('library', LibraryController::class);
    Route::post('/library/borrow', [LibraryController::class, 'borrow'])->name('library.borrow');
    Route::post('/library/return', [LibraryController::class, 'returnBook'])->name('library.return');
});
