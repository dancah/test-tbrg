<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
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

//get Produk
Route::get('getProduk',[ProdukController::class, 'getProduk']);

//get Produk detail
Route::get('get_produks/{id}',[ProdukController::class, 'get_produks']);

//save Produk
Route::post('saveProduk',[ProdukController::class, 'saveProduk']);

//update Produk
Route::post('UpdateProduk/{id}',[ProdukController::class, 'UpdateProduk']);

//delete Produk
Route::delete('deleteProduk/{id}',[ProdukController::class, 'deleteProduk']);
