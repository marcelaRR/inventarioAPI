<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Producto;

class ProductoWebController extends Controller
{
    public function index()
{
    $productos = Producto::with('categoria', 'movimientos')->get();

    $valorTotal = $productos->sum(function ($producto) {
        return $producto->stock_actual * $producto->precio_unitario;
    });

    return view('productos.index', compact('productos', 'valorTotal'));
}

    public function show(Producto $producto)
    {
        $producto->load(['categoria', 'movimientos']);
        return view('productos.show', compact('producto'));
    }
}
