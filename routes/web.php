<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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


Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//User Controller
Route::group(['middleware' => ['auth', 'permission::all']], function() {
    Route::resource('users', \App\Http\Controllers\UserController::class);
});
Route::group(['middleware' => ['auth']], function() {
    Route::get('users/{user}', [\App\Http\Controllers\UserController::class, 'show'])->name('users.show');
    Route::get('users/{user}/edit', [\App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
    Route::patch('users/{user}', [\App\Http\Controllers\UserController::class, 'update'])->name('users.update');
});

//Post Controller
Route::group(['middleware' => ['auth']], function() {
    Route::resource('blogs', \App\Http\Controllers\BlogController::class);
    Route::resource('plans', \App\Http\Controllers\PlanController::class);
});

