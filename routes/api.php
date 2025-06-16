<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CategoriaController;
use App\Http\Controllers\API\ProductoController;
use App\Http\Controllers\API\MovimientoController;
use App\Http\Controllers\API\InventarioController;

Route::get('/inventario/valor-total', [InventarioController::class, 'valorTotal']);


Route::apiResource('categorias', CategoriaController::class)->only(['index', 'store']);
Route::get('/test', function () {
    return 'API funcionando';
});

Route::get('movimientos', [MovimientoController::class, 'index']);
Route::post('movimientos', [MovimientoController::class, 'store']);
Route::apiResource('productos', ProductoController::class);

Route::get('/productos/{codigo}', [ProductoController::class, 'show']);
Route::put('/productos/{codigo}', [ProductoController::class, 'update']);
Route::delete('/productos/{codigo}', [ProductoController::class, 'destroy']);
