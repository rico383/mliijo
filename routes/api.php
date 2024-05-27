<?php

use App\Http\Controllers\Api\KeranjangController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\LoginApiController;
use App\Http\Controllers\Api\OrderApiController;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\Customer2Controller;
use App\Http\Controllers\Api\SearchApiController;
use App\Http\Controllers\Api\CartController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Authenticating
Route::post('/login', [LoginApiController::class, 'login']);
Route::post('/register', [LoginApiController::class, 'register']);
Route::post('/logout', [LoginApiController::class, 'logout']);

//Products (Mungkin t   idak semuanya terpakai/menyesuaikan)
Route::get('/products', [ProductApiController::class, 'index']);
Route::post('/products-add', [ProductApiController::class, 'store']);
Route::get('/products/{id}', [ProductApiController::class, 'show']);
Route::get('/products/category/{category}',[ProductApiController::class,'getByCategory']);
Route::get('/products/search/{name}',[ProductApiController::class,'getProdukByName']);

Route::post('/keranjangtambah', [KeranjangController::class, 'tambahKeranjang']);
Route::put('/keranjangupdate', [KeranjangController::class, 'updates']);
Route::get('/keranjang/{customer_id}', [KeranjangController::class, 'keranjangByUser']);
Route::delete('/keranjang_hapus/{id}', [KeranjangController::class, 'deleteKeranjang']);

//Searchda
Route::get('/search/{name}', [SearchApiController::class, 'search']);

//Orders (Mungkin tidak semuanya terpakai/menyesuaikan)
Route::get('/orders', [OrderApiController::class, 'index']);
Route::get('/orders-show/{customer_id}', [OrderApiController::class, 'show']);
Route::post('/orders-add', [OrderApiController::class, 'store']);
Route::put('/orders-image', [OrderApiController::class, 'update']);
Route::post('/oderuploadtransaksi', [OrderApiController::class, 'updateDeleteOrder']);


Route::delete('/orders-delete/{id}', [OrderApiController::class, 'destroy']);


//customer account (Mungkin tidak semuanya terpakai/menyesuaikan)
Route::get('/customer_accounts', [Customer2Controller::class, 'index']);
Route::get('/customer_accounts/{id}', [Customer2Controller::class, 'show']);
Route::put('/customer_accounts-update/{id}', [Customer2Controller::class, 'update']);
Route::delete('/customer_accounts/{id}', [Customer2Controller::class, 'destroy']);

//cart (Mungkin tidak semuanya terpakai/menyesuaikan)
Route::post('/cart-add', [CartController::class, 'store']);
Route::get('/cart/{customer_id}', [CartController::class, 'index']);
Route::post('/cart-add', [CartController::class, 'store']);
Route::post('/cart-delete/{id}', [CartController::class, 'destroy']);
Route::post('/cart-find/{id}', [CartController::class, 'show']);
