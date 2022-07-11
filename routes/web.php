<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\EmployeeDashboardController;

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

Route::get('/', [UserController::class, 'check_account'])->middleware('auth');

Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');


// Authentication
Route::prefix('/auth')->group(function (){
    Route::post('/login', [UserController::class, 'login']);
    Route::get('/logout', [UserController::class, 'logout']);
});

// Dashboards
Route::middleware('auth')->prefix('/dashboard')->group(function (){

    // Admin
    Route::middleware('admin.only')->prefix('/admin')->group(function (){
        Route::get('/index', [AdminDashboardController::class, 'index']);
        Route::get('/categories', [AdminDashboardController::class, 'categories']);
        Route::get('/supplies', [AdminDashboardController::class, 'supplies']);
        Route::get('/equipments', [AdminDashboardController::class, 'equipments']);
        Route::get('/inventory', [AdminDashboardController::class, 'inventory']);
        Route::get('/requests', [AdminDashboardController::class, 'requests']);
        Route::get('/employees', [AdminDashboardController::class, 'employees']);
        Route::get('/archived', [AdminDashboardController::class, 'archived']);
        Route::get('/settings', [AdminDashboardController::class, 'settings']);
    });

    // Employee
    Route::middleware('employee.only')->prefix('employee')->group(function (){
        Route::get('/index', [EmployeeDashboardController::class, 'index']);
        Route::get('/requests', [EmployeeDashboardController::class, 'requests']);
    });

});
