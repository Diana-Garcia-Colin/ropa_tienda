<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AsigTalla extends Model
{
    use HasFactory;

    protected $table = 'asig_talla';
    protected $fillable = ['id_entrada', 'cantidad', 'id_talla'];

    // Relación con Entrada
    public function entrada()
    {
        return $this->belongsTo(Entrada::class, 'id_entrada');
    }

    // Relación con Talla
    public function talla()
    {
        return $this->belongsTo(Talla::class, 'id_talla');
    }
}

