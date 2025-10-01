<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;

// Auth Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    // User routes
    Route::get('/profile', function (Request $request) {
        return response()->json($request->user());
    });
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource('courses', CourseController::class);
    Route::apiResource('tracks', TrackController::class);
    Route::apiResource('course-progress', CourseProgressController::class);
    Route::apiResource('quizzes', QuizController::class);   
    Route::apiResource('questions', QuestionController::class);
    Route::apiResource('options', OptionController::class);
    Route::apiResource('quiz-attempts', QuizAttemptController::class);
    Route::apiResource('certificates', CertificateController::class);
    Route::apiResource('enrollments', EnrollmentController::class);
    
});
