<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    public function approveUser(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $role = Role::findByName($request->role); // Rol seleccionado por el admin

        // Asignar el rol y aprobar al usuario
        $user->assignRole($role);
        $user->approved = true;
        $user->save();

        return redirect()->back()->with('success', 'Usuario aprobado y rol asignado correctamente.');
    }
    // AdminController.php
    public function usuariosNoAprobados()
    {
        // Obtener los usuarios que no están aprobados (usando el campo 'approved' en falso)
        $users = User::where('approved', false)->get();

        // Pasar los usuarios a la vista
        return view('admin.usuarios_no_aprobados', compact('users'));
    }


    public function showPendingUsers()
    {
        $users = User::where('approved', false)->get();
        return view('admin.usuarios_no_aprobados', compact('users'));
    }
    public function updateRole(Request $request, $userId)
        {
        $user = User::findOrFail($userId);
        $roleName = $request->input('role');

        // Primero, eliminamos todos los roles actuales
        $user->syncRoles([]);

        // Asignamos el nuevo rol
        $user->assignRole($roleName);

        return redirect()->back()->with('success', 'Rol actualizado correctamente.');
        }
    public function updateEmpresa(Request $request, $userId)
        {
        $user = User::findOrFail($userId);
        $user->empresa_id = $request->input('empresa_id'); // Asigna la empresa seleccionada
        $user->save();

        return redirect()->back()->with('success', 'Empresa asignada correctamente.');
        }
    public function updatePuesto(Request $request, $userId)
        {
            $user = User::findOrFail($userId);
            $user->puesto_id = $request->input('puesto');
            $user->save();

            return redirect()->back()->with('success', 'Puesto actualizado correctamente.');
        }

}
