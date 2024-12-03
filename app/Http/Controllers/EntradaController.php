<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use App\Models\Producto;
use App\Models\Entrada;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth;
class EntradaController extends Controller
{
    public function index()
    {
        // Obtener el usuario actualmente autenticado
        $user = auth()->user();

        // Verificar si el usuario tiene el rol de administrador (id_rol == 1)
        if ($user->id_rol == 1) {
            $entradas = Entrada::with(['proveedor', 'producto'])->paginate(10); // Obtener todas las entradas
        } else {
            // Si no es admin, solo obtener las entradas asociadas al proveedor del usuario
            $entradas = Entrada::whereHas('proveedor', function ($query) {
                $query->where('user_id', auth()->id());
            })->with(['proveedor', 'producto'])->paginate(10);
        }

        return view('admin.entradas.index', compact('entradas'));
    }


    public function create()
    {
        // Obtener solo el proveedor asociado al usuario autenticado
        $proveedor = Proveedor::where('user_id', auth()->id())->first();  // Obtén solo el primer proveedor del usuario
        if (!$proveedor) {
            return redirect()->route('proveedores.create')->with('error', 'No se encontró un proveedor asociado.');
        }
        // Obtener todos los productos disponibles
        $productos = Producto::with('tipoRopa')->get();

        return view('admin.entradas.create', compact('proveedor', 'productos'));
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
        $proveedor = Proveedor::where('user_id', auth()->id())->first();

        if (!$proveedor) {
            return redirect()->route('proveedores.create')->with('error', 'No se encontró un proveedor asociado.');
        }
        // Obtener productos disponibles
        $productos = Producto::with('tipoRopa')->get();

        return view('admin.entradas.edit', compact('entrada', 'proveedor', 'productos'));
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
