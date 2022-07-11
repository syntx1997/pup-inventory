<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\SettingController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

//Route::prefix('/auth')->group(function (){
//    Route::post('/login', [UserController::class, 'login']);
//});


// Category
Route::get('/category', [CategoryController::class, 'get_all']);
Route::post('/category', [CategoryController::class, 'add']);
Route::put('/category', [CategoryController::class, 'edit']);
Route::delete('/category', [CategoryController::class, 'delete']);

// Item | Supply or Equipment
Route::get('/item/get-all/{type}', [ItemController::class, 'get_all']);
Route::post('/item/restock', [ItemController::class, 'restock']);
Route::post('/item/set-critical', [ItemController::class, 'set_critical']);
Route::post('/item', [ItemController::class, 'add']);
Route::put('/item', [ItemController::class, 'edit']);
Route::delete('/item', [ItemController::class, 'delete']);

// Employee
Route::get('/employee', [EmployeeController::class, 'get_all']);
Route::post('/employee', [EmployeeController::class, 'add']);
Route::put('/employee', [EmployeeController::class, 'edit']);
Route::post('/employee/archive', [EmployeeController::class, 'archive']);
Route::get('/employee/archive', [EmployeeController::class, 'get_all_archived']);

// Request
Route::post('/request', [RequestController::class, 'add']);
Route::get('/request/all', [RequestController::class, 'all']);
Route::get('/request/get-all/{user_id}', [RequestController::class, 'get_all']);
Route::post('/request/accept', [RequestController::class, 'accept']);
Route::post('/request/decline', [RequestController::class, 'decline']);

// Settings
Route::post('/setting/information', [SettingController::class, 'update_info']);
Route::post('/setting/password', [SettingController::class, 'update_password']);
