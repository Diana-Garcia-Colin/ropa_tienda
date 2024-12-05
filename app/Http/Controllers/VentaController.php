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
        // Eager Loading para incluir todas las relaciones necesarias
        $ventas = Venta::with(['ticket', 'producto.tipoRopa', 'asigTalla.talla'])->get();

        // Retornar la vista con las ventas
        return view('admin.ventas.index', compact('ventas'));
    }

    // Mostrar el formulario para crear una nueva venta
    public function create()
    {
        $tickets = Ticket::all(); // Todos los tickets
        $productos = Producto::with('tipoRopa')->get(); // Todos los productos con su tipo de ropa
        $asigTallas = AsigTalla::with('talla')->get(); // Todas las asignaciones de tallas con sus tallas

        // Retornar la vista para crear ventas
        return view('admin.ventas.create', compact('tickets', 'productos', 'asigTallas'));
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

        // Redirigir al listado de ventas con un mensaje de éxito
        return redirect()->route('ventas.index')->with('success', 'Venta creada exitosamente.');
    }

    // Mostrar detalles de una venta específica
    public function show(Venta $venta)
    {
        // Retornar la vista con los detalles de la venta
        return view('admin.ventas.show', compact('venta'));
    }

    // Mostrar el formulario para editar una venta
    public function edit(Venta $venta)
    {
        $tickets = Ticket::all(); // Todos los tickets
        $productos = Producto::with('tipoRopa')->get(); // Todos los productos con su tipo de ropa
        $asigTallas = AsigTalla::with('talla')->get(); // Todas las asignaciones de tallas con sus tallas

        // Retornar la vista para editar la venta
        return view('admin.ventas.edit', compact('venta', 'tickets', 'productos', 'asigTallas'));
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

        // Redirigir al listado de ventas con un mensaje de éxito
        return redirect()->route('ventas.index')->with('success', 'Venta actualizada exitosamente.');
    }

    // Eliminar una venta
    public function destroy(Venta $venta)
    {
        // Eliminar la venta
        $venta->delete();

        // Redirigir al listado de ventas con un mensaje de éxito
        return redirect()->route('ventas.index')->with('success', 'Venta eliminada exitosamente.');
    }
}
