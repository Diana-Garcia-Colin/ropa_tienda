<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_ticket',
        'id_producto',
        'id_asigt',
        'cantidad',
        'subtotal',
    ];

    // Relaciones
    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'id_ticket');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }

    public function asigTalla()
    {
        return $this->belongsTo(AsigTalla::class, 'id_asigt');
    }
}
