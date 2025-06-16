<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\ProductoWebController;
use App\Http\Controllers\Web\MovimientoWebController;
use App\Models\Producto;
use App\Models\Movimiento;
use Illuminate\Http\Request;
use App\Exports\ProductosExport;
use Maatwebsite\Excel\Facades\Excel;

Route::delete('/productos/{codigo}', [ProductoWebController::class, 'destroy'])->name('productos.destroy');
Route::get('/exportar-productos', function () {
    return Excel::download(new ProductosExport, 'productos.xlsx');
})->name('productos.exportar');

Route::get('/reportes/productos/{producto}', function (Producto $producto) {
    $entradas = $producto->movimientos()->where('tipo', 'entrada')->sum('cantidad');
    $salidas = $producto->movimientos()->where('tipo', 'salida')->sum('cantidad');
    $stock = $entradas - $salidas;

    return view('reportes.producto', compact('producto', 'entradas', 'salidas', 'stock'));
})->name('reportes.producto');

Route::get('/reportes/producto/{codigo}', function ($codigo) {
    $producto = Producto::where('codigo', $codigo)->with('movimientos')->firstOrFail();

    $entradas = $producto->movimientos->where('tipo', 'entrada')->sum('cantidad');
    $salidas = $producto->movimientos->where('tipo', 'salida')->sum('cantidad');
    $stock = $entradas - $salidas;

    return view('reportes.producto', compact('producto', 'entradas', 'salidas', 'stock'));
})->name('reportes.producto');



// Vista para crear movimientos
Route::get('/movimientos/create', function () {
    $productos = Producto::all();
    return view('movimientos.create', compact('productos'));
})->name('movimientos.create');

// Guardar movimientos (opcional si ya está por API)
Route::get('/productos', [ProductoWebController::class, 'index'])->name('productos.index');

Route::get('/', [ProductoWebController::class, 'index'])->name('productos.index');
Route::get('/productos/{producto}', [ProductoWebController::class, 'show'])->name('productos.show');

Route::get('/movimientos/create', [MovimientoWebController::class, 'create'])->name('movimientos.create');
Route::post('/movimientos', [MovimientoWebController::class, 'store'])->name('movimientos.store');

Route::get('/', function () {
    return view('welcome');
});
