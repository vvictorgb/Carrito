<?php

use App\Http\Controllers\Api\LoginController;

use App\Http\Controllers\Api\CarritoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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



Route::delete('carrito', [CarritoController::class, 'destroy']);
Route::delete('carrito/{id}',[CarritoController::class, 'destroyAll']);
Route::put('carrito/{idUsuario}/{idProducto}/{cantidad}', [CarritoController::class, 'update']);

Route::apiResource('carrito', CarritoController::class)->except(['destroy','update']);
Route::post('login', [LoginController::class, 'login']);
