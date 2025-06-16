<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Movimiento;
use App\Http\Requests\MovimientoRequest;

class MovimientoController extends Controller
{
    public function index()
    {
        return Movimiento::with('producto')->get();
    }

    public function store(MovimientoRequest $request)
    {
        return Movimiento::create($request->validated());
    }
}
