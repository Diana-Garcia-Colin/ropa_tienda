<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Cliente;
use App\Models\Empleado;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::with(['cliente.user', 'empleado.user'])->paginate(10); // Lista tickets con clientes y empleados
        return view('admin.tickets.index', compact('tickets'));
    }

    public function create()
    {
        $clientes = Cliente::with('user')->get(); // Obtiene clientes
        $empleados = Empleado::with('user')->get(); // Obtiene empleados
        return view('admin.tickets.create', compact('clientes', 'empleados'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'fecha_ventas' => 'required|date',
            'id_cliente' => 'required|exists:clientes,id_cliente',
            'id_empleado' => 'required|exists:empleados,id_empleado',
            'total' => 'required|numeric|min:0',
        ]);

        Ticket::create($validatedData); // Crear ticket

        return redirect()->route('tickets.index')->with('success', 'Ticket creado correctamente.');
    }

    public function edit(Ticket $ticket)
    {
        $clientes = Cliente::with('user')->get(); // Obtiene clientes
        $empleados = Empleado::with('user')->get(); // Obtiene empleados
        return view('admin.tickets.edit', compact('ticket', 'clientes', 'empleados'));
    }

    public function update(Request $request, Ticket $ticket)
    {
        $validatedData = $request->validate([
            'fecha_ventas' => 'required|date',
            'id_cliente' => 'required|exists:clientes,id_cliente',
            'id_empleado' => 'required|exists:empleados,id_empleado',
            'total' => 'required|numeric|min:0',
        ]);

        $ticket->update($validatedData); // Actualizar ticket

        return redirect()->route('tickets.index')->with('success', 'Ticket actualizado correctamente.');
    }

    public function destroy(Ticket $ticket)
    {
        $ticket->delete(); // Eliminar ticket
        return redirect()->route('tickets.index')->with('success', 'Ticket eliminado correctamente.');
    }
}

