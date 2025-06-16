<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

public function rules()
{
    return [
        'codigo' => 'required|unique:productos,codigo,' . $this->producto . ',codigo',
        'nombre' => 'required|string|max:255',
        'categoria_id' => 'required|exists:categorias,id',
        'precio_unitario' => 'required|numeric|min:0',
    ];
}

}
