@extends('layout')

@section('content')
    <h2>Registrar Movimiento</h2>

    <form method="POST" action="{{ route('movimientos.store') }}">
        @csrf
        <div class="mb-3">
            <label for="producto_id" class="form-label">Producto</label>
            <select name="producto_id" class="form-select" required>
                @foreach($productos as $p)
                    <option value="{{ $p->id }}">{{ $p->nombre }} ({{ $p->codigo }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Tipo</label>
            <select name="tipo" class="form-select" required>
                <option value="entrada">Entrada</option>
                <option value="salida">Salida</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Cantidad</label>
            <input type="number" name="cantidad" class="form-control" required min="1">
        </div>

        <button type="submit" class="btn btn-primary">Registrar</button>
        <a href="{{ url('/productos') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection
