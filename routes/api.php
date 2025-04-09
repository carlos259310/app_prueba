<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ClienteController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// consultar todos
Route::get('/clientes',[ClienteController::class,'index']);
// consultar por id
Route::get('clientes/{IdCliente}',[ClienteController::class,'show']);
//insertar clientes
Route::post('/clientes',[ClienteController::class,'store']);

//insertar clientes
Route::put('clientes/{IdCliente}',[ClienteController::class,'update']);






Route::delete('clientes/{IdCliente}',[ClienteController::class,'destroy']);