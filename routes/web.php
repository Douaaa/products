<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;

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

Route::get('/',[HomeController::class,'index']);
Route::get('/create_account', [HomeController::class,'register']);
Route::get('/login_account', [HomeController::class,'login']);
Route::get('/my_products', [ProductController::class,'index']);
Route::get('/add_product', [ProductController::class,'add']);
