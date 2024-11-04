<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use App\Models\Producto;
use App\Models\Entrada;
use Illuminate\Http\Request;

class EntradaController extends Controller
{
    public function index()
    {
        // Cargar entradas con las relaciones de proveedor y producto
        $entradas = Entrada::with(['proveedor', 'producto'])->paginate(10);

        return view('admin.entradas.index', compact('entradas'));
    }



    public function create()
    {
        // Cargar proveedores con la relación del usuario
        $proveedores = Proveedor::with('user')->get();
        // Cargar productos con la relación de tipo de ropa
        $productos = Producto::with('tipoRopa')->get();

        return view('admin.entradas.create', compact('proveedores', 'productos'));
    }



    public function store(Request $request)
    {
        // Depuración
        \Log::info('Datos recibidos para la entrada: ', $request->all());

        $request->validate([
            'id_proveedor' => 'required|exists:proveedores,id_proveedor',
            'id_producto' => 'required|exists:productos,id',
            'precio_entrada' => 'required|numeric',
            'fecha_entrada' => 'required|date',
        ]);

        Entrada::create($request->all());
        return redirect()->route('entradas.index')->with('success', 'Entrada creada con éxito.');
    }


    public function show(Entrada $entrada)
    {
        return view('entradas.show', compact('entrada'));
    }

    public function edit(Entrada $entrada)
    {
        // Cargar proveedores y productos
        $proveedores = Proveedor::with('user')->get(); // Asegúrate de que el modelo Proveedor tiene la relación con el modelo User.
        $productos = Producto::with('tipoRopa')->get(); // Asegúrate de que el modelo Producto tiene la relación con tipoRopa.

        return view('admin.entradas.edit', compact('entrada', 'proveedores', 'productos'));
    }


    public function update(Request $request, Entrada $entrada)
    {
        $request->validate([
            'id_proveedor' => 'required|exists:proveedores,id_proveedor',
            'id_producto' => 'required|exists:productos,id',
            'precio_entrada' => 'required|numeric',
            'fecha_entrada' => 'required|date',
        ]);

        $entrada->update($request->all());
        return redirect()->route('entradas.index')->with('success', 'Entrada actualizada con éxito.');
    }

    public function destroy(Entrada $entrada)
    {
        $entrada->delete();
        return redirect()->route('entradas.index')->with('success', 'Entrada eliminada con éxito.');
    }
}
