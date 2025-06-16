<?php

namespace App\Http\Controllers\API;

use App\Models\Producto;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductoRequest;
use App\Http\Controllers\API\ProductoController;
use Illuminate\Http\Request;


class ProductoController extends Controller
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
    $producto->load('categoria', 'movimientos');

    $stock = $producto->movimientos->sum(function ($mov) {
        return $mov->tipo === 'entrada'
            ? $mov->cantidad
            : -$mov->cantidad;
    });

    return [
        'stock_actual' => $stock,
        'categoria' => $producto->categoria,
        'movimientos' => $producto->movimientos
    ];
}

    public function getRouteKeyName()
{
    return 'codigo';
}


public function update(Request $request, $codigo)
{
    $producto = Producto::where('codigo', $codigo)->first();

    if (!$producto) {
        return response()->json(['message' => 'Producto no encontrado'], 404);
    }

    $validated = $request->validate([
        'nombre' => 'required|string|max:255',
        'categoria_id' => 'required|integer|exists:categorias,id',
        'precio_unitario' => 'required|numeric|min:0'
    ]);

    $producto->update($validated);

    return response()->json(['message' => 'Producto actualizado con éxito', 'producto' => $producto]);
}


public function destroy($codigo)
{
    $producto = Producto::where('codigo', $codigo)->firstOrFail();
    $producto->delete();

    return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente');
}


}
