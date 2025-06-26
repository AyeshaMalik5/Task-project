<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\UserMiddleware;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\Usercontroller;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\emailController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NotificationController;


Route::get('register', function () {
    return view('register');
})->name('register');
Route::get('login', function () {
    return view('login');
});
Route::post('signup',[Usercontroller::class,'sign_up'])->name('signup');
// Route::post('login',[Usercontroller::class,'login'])->name('login')->middleware(AdminMiddleware::class);
Route::post('login', [UserController::class, 'login'])->name('login');
Route::post('logout',[Usercontroller::class,'logout'])->name('logout');
route::get('cutomer',[Usercontroller::class,'customer'])->name('customer');
route::get('layout',function(){

    return view('layout');
    })->name('layout');
    Route::get('/admin', [AdminController::class, 'index'])->name('admin')->middleware(AdminMiddleware::class);
    
    route::get('employee',function(){
    return view('customer');
    })->name('employee')->middleware(UserMiddleware::class);
    Route::get('store', function () {
        return view('task');
    })->name('task');
    Route::post('/task_data', [TaskController::class, 'store'])->name('store_data');

    Route::get('show/task',[TaskController::class, 'show'])->name('task_list');
    Route::get('admin/show', [AdminController::class, 'show'])->name('tasklist');

    // Route::post('/updateStatus',[TaskController::class,'updateStatus'])->name('updateStatuses');
    Route::patch('/tasks/{task}/status', [TaskController::class, 'updateStatus'])->name('updateStatuses');
    Route::get('/tasks/edit/{id}', [TaskController::class, 'editTask'])->name('editTask');
    Route::put('/tasks/edit/{id}', [TaskController::class, 'updateTask'])->name('updateTask');


    Route::get('/testemail', [emailController::class, 'testemail']);

Route::get('/notifications/read/{id}', [App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');

use App\Http\Controllers\Auth\GoogleController;

Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
