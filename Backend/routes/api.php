<?php

use App\Http\Controllers\Api\AccountController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\GoogleAuthController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\api\ProductAttributeController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ResetPasswordController;
use App\Http\Controllers\Api\SubcategoryController;
use App\Http\Controllers\Controller;
use App\Models\SubCategory;

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
 Route::post('products/{id}/update',[ProductController::class,'update']);
// Route::delete('products/{id}',[ProductController::class,'destroy']);
Route::apiResource('products',ProductController::class);
Route::get('statistical1',[ProductController::class,'statistical1']);
Route::get('statistical2',[ProductController::class,'statistical2']);

//Route::apiResource('product_attributes',ProductAttributeController::class);
Route::apiResource('accounts',AccountController::class);
Route::get('admin/orders',[OrderController::class,'index']);
Route::get('admin/orders/{id}',[OrderController::class,'showOrderDetail']);
Route::put('admin/orders/{id}',[OrderController::class,'updateStatus']);
Route::put('admin/orders/cancel/{id}',[OrderController::class,'cancelStatus']);
Route::middleware('auth:sanctum')->group(function(){
    Route::post('logout',[AuthController::class,'logout']);
    Route::get('orders',[OrderController::class,'showOrder']);
    //Order
    Route::post('orders',[OrderController::class,'addNewOrder']);
});
Route::middleware('auth:sanctum')->get('/user', function () {

});
Route::post('reset-password', [ResetPasswordController::class,'sendMail']);
Route::put('reset-password/{token}', [ResetPasswordController::class,'reset']);

// Route::post('/upload-image',[Controller::class,'uploadImage']); 

Route::get('categories',[CategoryController::class,'index']);
Route::get('subcategories',[SubcategoryController::class,'index']);

// Route::post('auth/google',[GoogleAuthController::class,'redirect']);



//Test some function
Route::get('product/test',[ProductController::class,'test']);