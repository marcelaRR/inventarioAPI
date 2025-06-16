<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Producto;

class InventarioController extends Controller
{
    public function valorTotal()
    {
        $valorTotal = Producto::all()->sum(function ($producto) {
            return $producto->stock_actual * $producto->precio_unitario;
        });

        return response()->json([
            'valor_total_inventario' => round($valorTotal, 2)
        ]);
    }
}

