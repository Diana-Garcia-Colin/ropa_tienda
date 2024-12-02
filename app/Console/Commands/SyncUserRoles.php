<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class SyncUserRoles extends Command
{
    // Definición del nombre y descripción del comando
    protected $signature = 'sync:user-roles';
    protected $description = 'Sincroniza el campo id_rol de la tabla users con model_has_roles';

    // Método principal del comando
    public function handle()
    {
        // Obtenemos todos los usuarios
        $users = User::all();

        // Iteramos sobre cada usuario
        foreach ($users as $user) {
            // Log para mostrar el ID del usuario procesado
            $this->info("Procesando usuario ID: {$user->id}");

            // Consultamos la tabla model_has_roles para obtener el rol asociado
            $role = DB::table('model_has_roles')
                ->where('model_id', $user->id)
                ->where('model_type', User::class)
                ->first();

            // Verificamos si se encontró un rol asociado
            if ($role) {
                // Log para mostrar el rol encontrado
                $this->info("Encontrado rol ID: {$role->role_id} para usuario ID: {$user->id}");

                // Actualizamos el campo id_rol en la tabla users
                $user->update(['id_rol' => $role->role_id]);
            } else {
                // Log si no se encuentra un rol
                $this->warn("No se encontró rol para usuario ID: {$user->id}");
            }
        }

        // Mensaje al finalizar la sincronización
        $this->info('Sincronización de roles completada.');
    }
}