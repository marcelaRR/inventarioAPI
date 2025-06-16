<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = ['codigo', 'nombre', 'categoria_id', 'precio_unitario'];

    protected $appends = ['stock_actual', 'nombre_categoria'];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function movimientos()
    {
        return $this->hasMany(Movimiento::class);
    }

    public function getRouteKeyName()
    {
        return 'codigo';
    }

    public function getStockActualAttribute()
    {
        $entradas = $this->movimientos()->where('tipo', 'entrada')->sum('cantidad');
        $salidas = $this->movimientos()->where('tipo', 'salida')->sum('cantidad');
        return $entradas - $salidas;
    }

    public function getNombreCategoriaAttribute()
    {
        return $this->categoria ? $this->categoria->nombre : null;
    }
}
