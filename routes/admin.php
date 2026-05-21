<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\Categories;




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
        Route::get('categories', [Categories::class, 'index'])->name('admin.categories.index');
        Route::get('add_category', [Categories::class, 'create'])->name('admin.categories.create');
        Route::get('edit_category/{id}', [Categories::class, 'edit'])->name('admin.categories.edit');
        Route::post('save_category', [Categories::class, 'save'])->name('admin.categories.save');
        Route::post('update_category/{id}', [Categories::class, 'update'])->name('admin.categories.update');
        Route::get('categories/delete/{id}', [Categories::class, 'delete'])->name('admin.categories.delete');
         // category routes end here


        Route::get('logout', function(){
                session()->forget('admin_id');
                return redirect()->route('admin.login');
        })->name('admin.logout');
    });
