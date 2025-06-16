@extends('layout')

@section('content')
    <h2>Listado de Productos</h2>

    <a href="{{ route('movimientos.create') }}" class="btn btn-success mb-3">Registrar Movimiento</a>
    <a href="{{ route('productos.exportar') }}" class="btn btn-success mb-3">Exportar a Excel</a>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Precio Unitario</th>
                <th>Stock Actual</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productos as $p)
                <tr>
                    <td>{{ $p->codigo }}</td>
                    <td>{{ $p->nombre }}</td>
                    <td>{{ $p->nombre_categoria }}</td>
                    <td>${{ number_format($p->precio_unitario, 2) }}</td>
                    <td class="{{ $p->stock_actual <= 0 ? 'text-danger' : 'text-success' }}">
                        {{ $p->stock_actual }}
                    </td>
                    <td>
                        <form action="{{ route('productos.destroy', $p->codigo) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de eliminar este producto?');">
                            @csrf
                            @method('DELETE')
                            <a href="{{ route('reportes.producto', $p->codigo) }}" class="btn btn-info btn-sm">Ver Reporte</a>
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="alert alert-info mt-3">
        <strong>Valor total del inventario:</strong> ${{ number_format($valorTotal, 2) }}
    </div>
@endsection
