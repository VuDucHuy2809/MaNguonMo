<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\api\ProductAttributeController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ResetPasswordController;

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

//product

// Route::get('products',[ProductController::class,'index']);
// Route::post('products',[ProductController::class,'store']);
// Route::get('products/{id}',[ProductController::class,'show']);
// Route::put('products/{id}/update',[ProductController::class,'update']);
// Route::delete('products/{id}',[ProductController::class,'destroy']);
Route::apiResource('products',ProductController::class);
Route::apiResource('product_attributes',ProductAttributeController::class);

Route::middleware('auth:sanctum')->group(function(){
    Route::post('logout',[AuthController::class,'logout']);
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return "Login success!!!" ;
});
Route::post('reset-password', [ResetPasswordController::class,'sendMail']);
Route::put('reset-password/{token}', [ResetPasswordController::class,'reset']);