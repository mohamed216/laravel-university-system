<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StudentApiController;
use App\Http\Controllers\Api\ProfessorApiController;
use App\Http\Controllers\Api\CourseApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group.
|
*/

// Public routes (if needed)
Route::post('/auth/login', [App\Http\Controllers\AuthController::class, 'login']);

// Protected routes (require authentication via Sanctum)
Route::middleware(['auth:sanctum'])->group(function () {
    // Auth
    Route::post('/auth/logout', [App\Http\Controllers\AuthController::class, 'logout']);
    Route::get('/auth/user', [App\Http\Controllers\AuthController::class, 'user']);
    Route::get('/auth/verify-email/{id}/{hash}', [App\Http\Controllers\AuthController::class, 'verifyEmail'])
        ->name('verification.verify');

    // Students API
    Route::apiResource('students', StudentApiController::class)->name('api.students');
    Route::get('students/{id}/enrollments', [StudentApiController::class, 'enrollments']);
    Route::get('students/{id}/grades', [StudentApiController::class, 'grades']);

    // Professors API
    Route::apiResource('professors', ProfessorApiController::class)->name('api.professors');
    Route::get('professors/{id}/courses', [ProfessorApiController::class, 'courses']);

    // Courses API
    Route::apiResource('courses', CourseApiController::class)->name('api.courses');
    Route::get('courses/{id}/sections', [CourseApiController::class, 'sections']);
    Route::get('courses/{id}/enrollments', [CourseApiController::class, 'enrollments']);

    // Additional API endpoints
    Route::get('departments', function () {
        return \App\Models\Department::with('faculty')->get();
    });

    Route::get('faculties', function () {
        return \App\Models\Faculty::all();
    });

    Route::get('academic-years', function () {
        return \App\Models\AcademicYear::all();
    });

    Route::get('semesters', function () {
        return \App\Models\Semester::with('academicYear')->get();
    });

    // Notifications API
    Route::get('notifications', [App\Http\Controllers\NotificationController::class, 'getUnread']);
    Route::post('notifications/{id}/read', [App\Http\Controllers\NotificationController::class, 'markAsRead']);
    Route::post('notifications/read-all', [App\Http\Controllers\NotificationController::class, 'markAllAsRead']);

    // Calendar API
    Route::get('calendar/events', [App\Http\Controllers\CalendarController::class, 'events']);
});
