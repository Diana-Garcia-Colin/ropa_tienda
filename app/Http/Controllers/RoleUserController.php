<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;


class RoleUserController extends Controller
{
    public function adminUsers()
    {
    $users = User::role('admin')->get(); // Obtiene usuarios con rol 'admin'
    $roles = Role::all(); // Obtener todos los roles
    return view('usuarios.admin', compact('users', 'roles'));
    }


    public function proveedorUsers()
    {
        $users = User::role('proveedor')->get(); // Obtiene usuarios con rol 'proveedor'
        return view('usuarios.proveedor', compact('users'));
        
        

    }

    public function clienteUsers()
    {
        $users = User::role('cliente')->get(); // Obtiene usuarios con rol 'cliente'
        return view('usuarios.cliente', compact('users'));
    }

    public function empleadoUsers()
    {

        $users = User::role('empleado')->get(); // Obtiene usuarios con rol 'empleado'
       $roles = Role::all(); // Obtener todos los roles
       return view('usuarios.empleado', compact('users', 'roles'));
    }
}
