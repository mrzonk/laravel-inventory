<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\LogoutController;
use App\Http\Controllers\Api\RegisterController;

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

Route::post('/register',App\Http\Controllers\Api\RegisterController::class)->name('register');
Route::post('/login',App\Http\Controllers\Api\LoginController::class)->name('login');
Route::get('/cari',App\Http\Controllers\Api\UserController::class)->name('cari');
Route::middleware('auth:api')->get('/user',function (Request $request){
    return $request->user();
});
Route::middleware('auth:api')->get('/show/supplier',[App\Http\Controllers\Api\SupplierController::class,'index']);
Route::middleware('auth:api')->post('/input/supplier',[App\Http\Controllers\Api\SupplierController::class,'store']);
Route::middleware('auth:api')->post('/show/supplier/{id}',[App\Http\Controllers\Api\SupplierController::class,'show']);
Route::middleware('auth:api')->post('/edit/supplier/{id}',[App\Http\Controllers\Api\SupplierController::class,'edit']);
Route::middleware('auth:api')->post('/delete/supplier/{id}',[App\Http\Controllers\Api\SupplierController::class,'destroy']);

Route::post('/logout',App\Http\Controllers\Api\LogoutController::class)->name('logout');