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

// Home
Route::get('/', [DashboardController::class, 'index'])->name('home');

// Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Faculties
Route::resource('faculties', FacultyController::class);

// Departments
Route::resource('departments', DepartmentController::class);

// Students
Route::resource('students', StudentController::class);
Route::get('/students/search', [StudentController::class, 'search'])->name('students.search');

// Professors
Route::resource('professors', ProfessorController::class);

// Courses
Route::resource('courses', CourseController::class);

// Enrollments
Route::resource('enrollments', EnrollmentController::class);
Route::post('/enrollments/approve/{enrollment}', [EnrollmentController::class, 'approve'])->name('enrollments.approve');
Route::post('/enrollments/drop/{enrollment}', [EnrollmentController::class, 'drop'])->name('enrollments.drop');

// Grades
Route::resource('grades', GradeController::class);
Route::post('/grades/submit', [GradeController::class, 'submit'])->name('grades.submit');

// Attendance
Route::resource('attendances', AttendanceController::class);
Route::post('/attendances/mark', [AttendanceController::class, 'mark'])->name('attendances.mark');

// Fees
Route::resource('fees', FeeController::class);

// Payments
Route::resource('payments', PaymentController::class);
Route::get('/payments/receipt/{payment}', [PaymentController::class, 'receipt'])->name('payments.receipt');

// Library
Route::resource('library', LibraryController::class);
Route::post('/library/borrow', [LibraryController::class, 'borrow'])->name('library.borrow');
Route::post('/library/return', [LibraryController::class, 'returnBook'])->name('library.return');
