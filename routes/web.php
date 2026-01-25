<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\JobController;

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
Route::get('jobs', [JobController::class, 'index'])->name('jobs.index');
Route::get('job_details/{id}', [JobController::class, 'jobDetails'])->name('jobs.details');
Route::post('apply_job', [JobController::class, 'applyForJob'])->name('apply_job');
Route::post('save_job', [JobController::class, 'saveJobs'])->name('save_job');


Route::middleware('guest')->group(function(){
    Route::get('register', [AuthController::class, 'register'])->name('register');
    Route::post('register-save', [AuthController::class, 'registerSave'])->name('register-save');
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login-check', [AuthController::class, 'loginCheck'])->name('login-check');
});

Route::middleware('auth')->group(function(){
    Route::get('profile', [MainController::class, 'profile'])->name('profile');
    Route::get('my_jobs', [MainController::class, 'myJobs'])->name('my_jobs');
    Route::get('applied_jobs', [MainController::class, 'appliedJobs'])->name('applied_jobs');
    Route::get('saved_jobs', [MainController::class, 'savedJobs'])->name('saved_jobs');
    Route::get('post_job', [MainController::class, 'postJob'])->name('post_job');
    Route::get('edit_job/{id}', [MainController::class, 'editJob'])->name('edit_job');
    Route::post('update_job/{id}', [MainController::class, 'updateJob'])->name('update_job');
    Route::post('save_job_data', [MainController::class, 'postJobData'])->name('save_job_data');
    Route::post('profile-update', [MainController::class, 'profileUpdate'])->name('profile-update');
    Route::get('delete_job/{id}', [MainController::class, 'destroy'])->name('delete_job');
    Route::get('delete_apply/{id}', [MainController::class, 'deleteApply'])->name('delete_apply');
    Route::get('delete_saved/{id}', [MainController::class, 'deleteSaved'])->name('delete_saved');
    Route::post('profile-image-update', [MainController::class, 'updateProfilePicture'])->name('profile-image-update');
   
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});