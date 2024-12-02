<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\User;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::with('user')->paginate(10); // Lista clientes con sus usuarios
        return view('admin.clientes.index', compact('clientes'));
    }

    public function create()
    {
        $users = User::role('cliente')->get(); // Usuarios con el rol 'cliente'
        return view('admin.clientes.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id', // Validación para asegurar que el usuario existe
        ]);

        Cliente::create($validatedData); // Crea un nuevo cliente

        return redirect()->route('clientes.index')->with('success', 'Cliente creado correctamente.');
    }

    public function show(Cliente $cliente)
    {
        return view('admin.clientes.show', compact('cliente')); // Muestra detalles del cliente
    }

    public function edit(Cliente $cliente)
    {
        $users = User::role('cliente')->get(); // Usuarios con el rol 'cliente'
        return view('admin.clientes.edit', compact('cliente', 'users'));
    }

    public function update(Request $request, Cliente $cliente)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id', // Validación para asegurar que el usuario existe
        ]);

        $cliente->update($validatedData); // Actualiza el cliente

        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado correctamente.');
    }

    public function destroy(Cliente $cliente)
    {
        $cliente->delete(); // Elimina el cliente
        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado correctamente.');
    }
}
