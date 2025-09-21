<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;





//  login routes

// admin data (registration) seeded in userseeder
Route::Post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);






// 🔹 Admin protected routes
Route::middleware(['auth:api', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return response()->json(['msg' => 'Welcome Admin dashborad']);
    });

    //course
    Route::post('/create-course', [CourseController::class, 'createCourse']);
    Route::get('/get-course', [CourseController::class, 'getCourse']);
    Route::post('/update-course/{id}', [CourseController::class, 'updateCourse']);
    Route::delete('/delete-course/{id}', [CourseController::class, 'deleteCourse']);

    
});

// 🔹 User protected routes
Route::middleware(['auth:api', 'user'])->prefix('user')->group(function () {
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::get('index', [AuthController::class, 'index']);

    // entrollment system
    Route::get('/my-courses', [EnrollmentController::class, 'myCourses']);
    Route::post('/entroll-course', [EnrollmentController::class, 'enroll']);
    Route::get('/course-entrollment-data', [CourseController::class, 'CourseData']);

});
