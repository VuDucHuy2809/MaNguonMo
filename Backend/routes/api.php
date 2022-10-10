<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;

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
//
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::post('products/add',[ProductController::class,'store']);
Route::get('products',[ProductController::class,'index']);
Route::get('products/{id}/',[ProductController::class,'show']);
// Route::put('products/{id}/update',[ProductController::class,'update']);
Route::post('products/{id}/',[ProductController::class,'update']);
Route::delete('products/{id}',[ProductController::class,'destroy']);

Route::middleware('auth:sanctum')->group(function(){
    Route::post('logout',[AuthController::class,'logout']);
});
