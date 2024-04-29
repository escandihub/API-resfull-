<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AuthController;
use Illuminate\Routing\RouteGroup;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


use App\Http\Middleware\LogMiddleware;
use App\Http\Middleware\AuthenticationMiddleware;


//public access
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'store']);
// Route::resource('customer', CustomerController::class)->except('show','update','create','edit');
//AuthClient
Route::post('customer', [CustomerController::class, 'store'])
->middleware(LogMiddleware::class,'AuthClient','storeCustomer');
Route::delete('customer/{dni}', [CustomerController::class, 'destroy'])
->middleware(LogMiddleware::class,'AuthClient');
Route::get('customer', [CustomerController::class, 'index'])
->middleware(LogMiddleware::class,'AuthClient');;
