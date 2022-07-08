<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;

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


// Categories
Route::get('/category', [CategoryController::class, 'get_all']);
Route::post('/category', [CategoryController::class, 'add']);
Route::put('/category', [CategoryController::class, 'edit']);
Route::delete('/category', [CategoryController::class, 'delete']);

// Items | Supply or Equipment
Route::get('/item/get-all/{type}', [ItemController::class, 'get_all']);
Route::post('/item/restock', [ItemController::class, 'restock']);
Route::post('/item/set-critical', [ItemController::class, 'set_critical']);
Route::post('/item', [ItemController::class, 'add']);
Route::put('/item', [ItemController::class, 'edit']);
Route::delete('/item', [ItemController::class, 'delete']);

