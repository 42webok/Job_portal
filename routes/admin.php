<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;




    Route::get('login', [LoginController::class, 'login'])->name('admin.login');
    Route::post('login_check', [LoginController::class, 'loginCheck'])->name('admin.loginCheck');


    Route::middleware(['admin'])->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('logout', function(){
                session()->forget('admin_id');
                return redirect()->route('admin.login');
        })->name('admin.logout');
    });
