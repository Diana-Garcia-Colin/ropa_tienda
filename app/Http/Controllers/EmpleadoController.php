<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use App\Models\User;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    public function index()
    {
        $empleados = Empleado::with('user')->paginate(10); // Lista empleados con sus usuarios
        return view('admin.empleados.index', compact('empleados'));
    }

    public function create()
    {
        $users = User::role('empleado')->get(); // Usuarios con el rol 'empleado'
        return view('admin.empleados.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id', // Validar que el usuario exista
        ]);

        Empleado::create($validatedData); // Crear un nuevo empleado

        return redirect()->route('empleados.index')->with('success', 'Empleado creado correctamente.');
    }

    public function show(Empleado $empleado)
    {
        return view('admin.empleados.show', compact('empleado')); // Mostrar detalles del empleado
    }

    public function edit(Empleado $empleado)
    {
        $users = User::role('empleado')->get(); // Usuarios con el rol 'empleado'
        return view('admin.empleados.edit', compact('empleado', 'users'));
    }

    public function update(Request $request, Empleado $empleado)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id', // Validar que el usuario exista
        ]);

        $empleado->update($validatedData); // Actualizar empleado

        return redirect()->route('empleados.index')->with('success', 'Empleado actualizado correctamente.');
    }

    public function destroy(Empleado $empleado)
    {
        $empleado->delete(); // Eliminar empleado
        return redirect()->route('empleados.index')->with('success', 'Empleado eliminado correctamente.');
    }
}
