<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'ap',
        'am',
        'email',
        'password',
        'id_rol',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function tipoRol()
    {
        return $this->belongsTo(Role::class, 'id_rol'); 
    }

    protected static function booted()
    {
        static::saved(function ($user) {
            if ($user->roles()->exists()) {
                $role = $user->roles->first();
                $user->updateQuietly(['id_rol' => $role->id]); // Actualización sincronizada
            }
        });
    }
}