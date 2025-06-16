@extends('layout')

@section('content')
    <h2>Reporte de Movimientos</h2>
    <h4>{{ $producto->nombre }} ({{ $producto->codigo }})</h4>

    <table class="table table-bordered mt-3">
        <thead class="table-light">
            <tr>
                <th>Fecha</th>
                <th>Tipo</th>
                <th>Cantidad</th>
            </tr>
        </thead>
        <tbody>
            @foreach($producto->movimientos as $m)
                <tr>
                    <td>{{ $m->created_at->format('Y-m-d H:i') }}</td>
                    <td>{{ ucfirst($m->tipo) }}</td>
                    <td>{{ $m->cantidad }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <hr>
    <p><strong>Total entradas:</strong> {{ $entradas }}</p>
    <p><strong>Total salidas:</strong> {{ $salidas }}</p>
    <p><strong>Stock actual:</strong> {{ $stock }}</p>

    <a href="{{ url('/productos') }}" class="btn btn-secondary">Volver</a>


@endsection
