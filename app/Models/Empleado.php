<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $table = 'empleados'; // Tabla asociada
    protected $primaryKey = 'id_empleado'; // Llave primaria
    protected $fillable = ['user_id']; // Campos rellenables

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // Relación con usuarios
    }
}
