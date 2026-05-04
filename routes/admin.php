<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\UserController;




    Route::get('login', [LoginController::class, 'login'])->name('admin.login');
    Route::post('login_check', [LoginController::class, 'loginCheck'])->name('admin.loginCheck');


    Route::middleware(['admin'])->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        // users routes start from here
        Route::get('users', [UserController::class, 'index'])->name('admin.users.index');
        Route::get('add_user', [UserController::class, 'create'])->name('admin.users.create');
        Route::get('edit_user/{id}', [UserController::class, 'edit'])->name('admin.users.edit');
        Route::post('save_user', [UserController::class, 'save'])->name('admin.users.save');
        Route::post('update_user/{id}', [UserController::class, 'update'])->name('admin.users.update');
        // users routes end here
        // category routes start from here
        Route::get('categories', [CategoryController::class, 'index'])->name('admin.categories.index');
        Route::get('add_category', [CategoryController::class, 'create'])->name('admin.categories.create');
        Route::get('edit_category/{id}', [CategoryController::class, 'edit'])->name('admin.categories.edit');
        Route::post('save_category', [CategoryController::class, 'save'])->name('admin.categories.save');
        Route::post('update_category/{id}', [CategoryController::class, 'update'])->name('admin.categories.update');
         // category routes end here


        Route::get('logout', function(){
                session()->forget('admin_id');
                return redirect()->route('admin.login');
        })->name('admin.logout');
    });
