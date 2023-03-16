<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\QueueController;
use App\Http\Controllers\API\DoctorController;
use App\Http\Controllers\API\NewsCategoryController;
use App\Http\Controllers\API\NewsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//API route for register new user
Route::post('/register', [AuthController::class, 'register'])->middleware(['cors']);
//API route for login user
Route::post('/login', [AuthController::class, 'login'])->middleware(['cors']);

//Protecting Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/profile', function(Request $request) {
        return auth()->user();
    })->middleware(['cors']);

    Route::get('/getprofile/{email}', [AuthController::class, 'getProfile'])->middleware(['cors']);
    Route::put('/updateprofile/{email}', [AuthController::class, 'updateProfile'])->middleware(['cors']);

    // Queue
    Route::prefix('queue')->group(function () {
        Route::get('/', [QueueController::class, 'index'])->middleware(['cors']);
        Route::get('/show/{id}', [QueueController::class, 'show'])->middleware(['cors']);
        Route::get('/show-user/{id}', [QueueController::class, 'showByUser'])->middleware(['cors']);
        Route::get('/show-email/{email}', [QueueController::class, 'showByEmail'])->middleware(['cors']);
        Route::get('/show-email-history/{email}', [QueueController::class, 'showByEmailHistory'])->middleware(['cors']);
        Route::post('/store', [QueueController::class, 'store'])->middleware(['cors']);
        Route::post('/update/{id}', [QueueController::class, 'update'])->middleware(['cors']);
        Route::delete('/delete/{id}', [QueueController::class, 'destroy'])->middleware(['cors']);
    });

    // Doctor
    Route::prefix('doctor')->group(function () {
        Route::get('/', [DoctorController::class, 'index'])->middleware(['cors']);
        Route::get('/show/{id}', [DoctorController::class, 'show'])->middleware(['cors']);
        Route::post('/store', [DoctorController::class, 'store'])->middleware(['cors']);
        Route::post('/update/{id}', [DoctorController::class, 'update'])->middleware(['cors']);
        Route::delete('/delete/{id}', [DoctorController::class, 'destroy'])->middleware(['cors']);
    });

    // News Category
    Route::prefix('news-category')->group(function () {
        Route::get('/', [NewsCategoryController::class, 'index'])->middleware(['cors']);
        Route::get('/show/{id}', [NewsCategoryController::class, 'show'])->middleware(['cors']);
        Route::post('/store', [NewsCategoryController::class, 'store'])->middleware(['cors']);
        Route::post('/update/{id}', [NewsCategoryController::class, 'update'])->middleware(['cors']);
        Route::delete('/delete/{id}', [NewsCategoryController::class, 'destroy'])->middleware(['cors']);
    });

    // News
    Route::prefix('news')->group(function () {
        Route::get('/', [NewsController::class, 'index'])->middleware(['cors']);
        Route::get('/show/{id}', [NewsController::class, 'show'])->middleware(['cors']);
        Route::post('/store', [NewsController::class, 'store'])->middleware(['cors']);
        Route::post('/update/{id}', [NewsController::class, 'update'])->middleware(['cors']);
        Route::delete('/delete/{id}', [NewsController::class, 'destroy'])->middleware(['cors']);
    });

    // API route for logout user
    Route::post('/logout', [AuthController::class, 'logout'])->middleware(['cors']);
});
