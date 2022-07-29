<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QueueController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/logout', [AuthController::class, 'logout_user']);

// Queue
Route::prefix('queue')->group(function () {
    Route::get('/', [QueueController::class, 'index']);
    Route::get('/show/{id}', [QueueController::class, 'show']);
    Route::post('/store', [QueueController::class, 'store']);
    Route::post('/update/{id}', [QueueController::class, 'update']);
    Route::get('/delete/{id}', [QueueController::class, 'destroy']);
    Route::get('/getdata/{id}', [QueueController::class, 'getdata']);
});
