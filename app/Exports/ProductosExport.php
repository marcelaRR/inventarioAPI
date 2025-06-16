<?php

namespace App\Exports;

use App\Models\Producto;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductosExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Producto::with('categoria', 'movimientos')->get()->map(function ($producto) {
            // Cálculo del stock
            $stock = $producto->movimientos->sum(fn ($m) => $m->tipo === 'entrada' ? $m->cantidad : -$m->cantidad);

            return [
                'Código'           => $producto->codigo,
                'Nombre'           => $producto->nombre,
                'Categoría'        => $producto->categoria->nombre,
                'Precio Unitario'  => $producto->precio_unitario,
                'Stock Actual'     => $stock,
                'Valor Total'      => $stock * $producto->precio_unitario,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Código',
            'Nombre',
            'Categoría',
            'Precio Unitario',
            'Stock Actual',
            'Valor Total',
        ];
    }
}
