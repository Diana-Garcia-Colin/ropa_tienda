<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_tipo_ropa', // Relación con Tipo de Ropa
        'precio',       // Precio del producto
        'id_marca',     // Relación con Marca
        'id_categoria',  // Relación con Categoría
        'imagen'        // Imagen del producto
    ];

    // Relación con TipoRopa
    public function tipoRopa()
    {
        return $this->belongsTo(Tipo_ropa::class, 'id_tipo_ropa');
    }

    // Relación con Marca
    public function marca()
    {
        return $this->belongsTo(Marcas::class, 'id_marca');
    }

    // Relación con Categoria
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }
}
