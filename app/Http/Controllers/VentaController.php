<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Ticket;
use App\Models\Producto;
use App\Models\AsigTalla;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    // Mostrar todas las ventas
    public function index()
    {
        $ventas = Venta::with(['ticket', 'producto', 'asigTalla'])->get();
        return view('admin.ventas.index', compact('ventas')); // Vista de ventas en el admin
    }

    // Mostrar el formulario para crear una nueva venta
    public function create()
    {
        $tickets = Ticket::all(); // Todos los tickets
        $productos = Producto::all(); // Todos los productos
        $asigTallas = AsigTalla::all(); // Todas las asignaciones de tallas

        return view('admin.ventas.create', compact('tickets', 'productos', 'asigTallas')); // Vista para crear ventas
    }

    // Almacenar una nueva venta
    public function store(Request $request)
    {
        // Validación de los campos del formulario
        $request->validate([
            'id_ticket' => 'required|exists:tickets,id_ticket',
            'id_producto' => 'required|exists:productos,id',
            'id_asigt' => 'required|exists:asig_talla,id',
            'cantidad' => 'required|integer|min:1',
            'subtotal' => 'required|numeric|min:0',
        ]);

        // Crear la venta
        Venta::create($request->all());
        return redirect()->route('ventas.index')->with('success', 'Venta creada exitosamente.');
    }

    // Mostrar detalles de una venta específica
    public function show(Venta $venta)
    {
        return view('admin.ventas.show', compact('venta')); // Vista de detalles de venta
    }

    // Mostrar el formulario para editar una venta
    public function edit(Venta $venta)
    {
        $tickets = Ticket::all(); // Todos los tickets
        $productos = Producto::all(); // Todos los productos
        $asigTallas = AsigTalla::all(); // Todas las asignaciones de tallas

        return view('admin.ventas.edit', compact('venta', 'tickets', 'productos', 'asigTallas')); // Vista para editar ventas
    }

    // Actualizar los detalles de una venta
    public function update(Request $request, Venta $venta)
    {
        // Validación de los campos del formulario
        $request->validate([
            'id_ticket' => 'required|exists:tickets,id_ticket',
            'id_producto' => 'required|exists:productos,id',
            'id_asigt' => 'required|exists:asig_talla,id',
            'cantidad' => 'required|integer|min:1',
            'subtotal' => 'required|numeric|min:0',
        ]);

        // Actualizar la venta
        $venta->update($request->all());
        return redirect()->route('ventas.index')->with('success', 'Venta actualizada exitosamente.');
    }

    // Eliminar una venta
    public function destroy(Venta $venta)
    {
        $venta->delete();
        return redirect()->route('ventas.index')->with('success', 'Venta eliminada exitosamente.');
    }
}
