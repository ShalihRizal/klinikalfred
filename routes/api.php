<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\QueueController;

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

    // Queue
    Route::prefix('queue')->group(function () {
        Route::get('/', [QueueController::class, 'index'])->middleware(['cors']);
        Route::get('/show/{id}', [QueueController::class, 'show'])->middleware(['cors']);
        Route::post('/store', [QueueController::class, 'store'])->middleware(['cors']);
        Route::post('/update/{id}', [QueueController::class, 'update'])->middleware(['cors']);
        Route::delete('/delete/{id}', [QueueController::class, 'destroy'])->middleware(['cors']);
    });

    // API route for logout user
    Route::post('/logout', [AuthController::class, 'logout'])->middleware(['cors']);
});
