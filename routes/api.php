<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CustomerController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [RegisterController::class, 'register']);

Route::post('login', [RegisterController::class, 'login']);

Route::middleware('auth:api')->group( function () {

    Route::post('create', [ProductController::class,'createProduct']);
    Route::get('list',[ProductController::class,'list']);
    Route::put('update/{id}',[ProductController::class,'update']);
    Route::delete('delete/{id}',[ProductController::class,'productDelete']);

});

Route::middleware('auth:api')->group( function () {

    Route::post('createmployee', [EmployeeController::class,'createEmployee']);
    Route::get('list', [EmployeeController::class,'list']);
    Route::put('employeeupdate/{id}', [EmployeeController::class,'employeeUpdate']);
    Route::delete('employedelete/{id}', [EmployeeController::class,'employeedelete']);

});

Route::middleware('auth:api')->group( function () {
    Route::post('createcustomer',[CustomerController::class,'createCustomer']);
    Route::get('listcustomer',[CustomerController::class,'createList']);
    Route::put('cupdate/{id}',[CustomerController::class,'customerUpdate']);
});