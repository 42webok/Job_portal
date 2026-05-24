<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\Categories;
use App\Http\Controllers\Admin\JobController;
use App\Http\Controllers\Admin\SkillController;




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
        //  job route  here 
        Route::get('jobs', [JobController::class, 'index'])->name('jobs.index');
        Route::get('add_job', [JobController::class, 'create'])->name('jobs.create');
        Route::post('save_job', [JobController::class, 'save'])->name('jobs.save');
        Route::post('job_upload-image', [JobController::class, 'upload_summernote_image'])
         ->name('summernote.upload');
        Route::get('edit_job/{id}', [JobController::class, 'edit'])->name('jobs.edit');
        Route::post('save_job/{id}', [JobController::class, 'update'])->name('jobs.update');
        Route::get('delete_job/{id}', [JobController::class, 'delete'])->name('jobs.delete');

        // skill routes start from here
        Route::get('skills', [SkillController::class, 'index'])->name('skills.index');
        Route::get('add_skill', [SkillController::class, 'create'])->name('skills.create');
        Route::post('store_skill', [SkillController::class, 'store'])->name('skills.store');
        Route::get('edit_skill/{id}', [SkillController::class, 'edit'])->name('skills.edit');
        Route::post('update_skill/{id}', [SkillController::class, 'update'])->name('skills.update');
        Route::get('delete_skill/{id}', [SkillController::class, 'delete'])->name('skills.delete');


        Route::get('logout', function(){
                session()->forget('admin_id');
                return redirect()->route('admin.login');
        })->name('admin.logout');
    });
