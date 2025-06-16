<?php

namespace App\Http\Controllers\API;


use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Http\Requests\CategoriaRequest;
use Illuminate\Http\Request;


class CategoriaController extends Controller
{
    public function index()
    {
        return Categoria::all();
    }

public function store(CategoriaRequest $request)
{
    return Categoria::create($request->validated());
}

}
