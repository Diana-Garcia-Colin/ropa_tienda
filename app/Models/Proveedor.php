<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    protected $table = 'proveedores'; // Asegúrate de que esté correcto
    protected $primaryKey = 'id_proveedor';
    protected $fillable = ['user_id', 'id_empresa']; // Cambia 'id_user' por 'user_id'

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // Cambiado a 'user_id'
    }

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'id_empresa');
    }
    public function users()
    {
        return $this->belongsTo(User::class, 'id_user'); // Verifica que esta relación sea correcta
    }

}
