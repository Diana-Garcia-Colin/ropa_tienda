<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $table = 'tickets'; // Nombre de la tabla
    protected $primaryKey = 'id_ticket'; // Llave primaria personalizada
    protected $fillable = ['fecha_ventas', 'id_cliente', 'id_empleado', 'total']; // Campos rellenables

    // Relaciones
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente'); // Relación con cliente
    }

    public function empleado()
    {
        return $this->belongsTo(Empleado::class, 'id_empleado'); // Relación con empleado
    }
}
