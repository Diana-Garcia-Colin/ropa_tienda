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
        $user = auth()->user();

        if ($user->id_rol == 1) {
            $entradas = Entrada::with(['proveedor', 'producto'])->paginate(10);
        } else {
            $entradas = Entrada::whereHas('proveedor', function ($query) {
                $query->where('user_id', auth()->id());
            })->with(['proveedor', 'producto'])->paginate(10);
        }

        return view('admin.entradas.index', compact('entradas'));
    }

    public function create()
    {
        $user = auth()->user();

        if ($user->id_rol == 1) {
            // Si el usuario es administrador, obtener todos los proveedores
            $proveedores = Proveedor::with('user')->get();
        } else {
            // Obtener solo el proveedor asociado al usuario autenticado
            $proveedores = Proveedor::where('user_id', $user->id)->with('user')->get();

            if ($proveedores->isEmpty()) {
                return redirect()->route('proveedores.create')->with('error', 'No se encontró un proveedor asociado.');
            }
        }

        $productos = Producto::with('tipoRopa')->get();

        return view('admin.entradas.create', compact('proveedores', 'productos'));
    }

    public function store(Request $request)
    {
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
        $user = auth()->user();

        if ($user->id_rol == 1) {
            $proveedores = Proveedor::with('user')->get();
        } else {
            $proveedores = Proveedor::where('user_id', $user->id)->with('user')->get();

            if ($proveedores->isEmpty()) {
                return redirect()->route('proveedores.create')->with('error', 'No se encontró un proveedor asociado.');
            }
        }

        $productos = Producto::with('tipoRopa')->get();

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
