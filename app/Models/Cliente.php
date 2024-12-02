<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes'; // Nombre de la tabla
    protected $primaryKey = 'id_cliente'; // Llave primaria personalizada
    protected $fillable = ['user_id']; // Atributos asignables en masa

    // Relaciones
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // Relación con la tabla de usuarios
    }
}
