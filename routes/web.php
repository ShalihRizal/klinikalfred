<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QueueController;
use App\Http\Controllers\NewsCategoryController;
use App\Http\Controllers\NewsController;

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
    Route::post('/update-status/{id}', [QueueController::class, 'update_user']);
    Route::get('/delete/{id}', [QueueController::class, 'destroy']);
    Route::get('/getdata/{id}', [QueueController::class, 'getdata']);
});

// News Category
Route::prefix('news-category')->group(function () {
    Route::get('/', [NewsCategoryController::class, 'index']);
    Route::get('/show/{id}', [NewsCategoryController::class, 'show']);
    Route::post('/store', [NewsCategoryController::class, 'store']);
    Route::post('/update/{id}', [NewsCategoryController::class, 'update']);
    Route::get('/delete/{id}', [NewsCategoryController::class, 'destroy']);
    Route::get('/getdata/{id}', [NewsCategoryController::class, 'getdata']);
});

// News
Route::prefix('news')->group(function () {
    Route::get('/', [NewsController::class, 'index']);
    Route::get('/show/{id}', [NewsController::class, 'show']);
    Route::post('/store', [NewsController::class, 'store']);
    Route::post('/update/{id}', [NewsController::class, 'update']);
    Route::get('/delete/{id}', [NewsController::class, 'destroy']);
    Route::get('/getdata/{id}', [NewsController::class, 'getdata']);
});
