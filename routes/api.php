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
    Route::apiResource('students', StudentApiController::class)->names('api.students');
    Route::get('students/{id}/enrollments', [StudentApiController::class, 'enrollments']);
    Route::get('students/{id}/grades', [StudentApiController::class, 'grades']);

    // Professors API
    Route::apiResource('professors', ProfessorApiController::class)->names('api.professors');
    Route::get('professors/{id}/courses', [ProfessorApiController::class, 'courses']);

    // Courses API
    Route::apiResource('courses', CourseApiController::class)->names('api.courses');
});
