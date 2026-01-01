<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;

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

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::middleware('guest')->group(function(){
    Route::get('register', [AuthController::class, 'register'])->name('register');
    Route::post('register-save', [AuthController::class, 'registerSave'])->name('register-save');
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login-check', [AuthController::class, 'loginCheck'])->name('login-check');
});

Route::middleware('auth')->group(function(){
    Route::get('profile', [MainController::class, 'profile'])->name('profile');
    Route::post('profile-update', [MainController::class, 'profileUpdate'])->name('profile-update');
    Route::post('profile-image-update', [MainController::class, 'updateProfilePicture'])->name('profile-image-update');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});