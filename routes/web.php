<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });
// only admin can access
// Route::middleware(['auth:api','admin'])->group(function () {
//     Route::get('/profile', [UserController::class, 'profile']);
// });


// // only user can access
// Route::middleware(['auth:api', 'user'])->group( function () {
//         Route::get('/profile', [UserController::class, 'profile']);

// });
