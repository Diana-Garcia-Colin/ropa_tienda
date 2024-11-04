<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Tipo_ropa; // Importar modelo
use App\Models\Marcas; // Importar modelo
use App\Models\Categoria; // Importar modelo
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductoController extends Controller
{
    // Mostrar todos los productos con paginación
    public function index()
    {
        $productos = Producto::paginate(10); // Configura la paginación, ajusta el número de items por página
        return view('admin.productos.index', compact('productos'));
    }

    // Mostrar el formulario de creación
    public function create()
    {
        $tipo_ropas = Tipo_ropa::all(); // Obtener todos los tipos de ropa
        $marcas = Marcas::all(); // Obtener todas las marcas
        $categorias = Categoria::all(); // Obtener todas las categorías

        return view('admin.productos.create', compact('tipo_ropas', 'marcas', 'categorias')); // Pasa las variables a la vista
    }
    // Guardar un nuevo producto
    
public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_tipo_ropa' => 'required|exists:tipo_ropas,id',
            'precio' => 'required|numeric',
            'id_marca' => 'required|exists:marcas,id',
            'id_categoria' => 'required|exists:categorias,id',
            'imagen' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048', // 2MB max
        ]);

        if ($validator->fails()) {
            return redirect()->route('productos.create')
                ->withErrors($validator)
                ->withInput();
        }

        // Guardar la imagen
        if ($request->hasFile('imagen')) {
            $imagenPath = $request->file('imagen')->store('imagenes', 'public');
        }

        // Guardar el producto
        $producto = new Producto();
        $producto->id_tipo_ropa = $request->id_tipo_ropa;
        $producto->precio = $request->precio;
        $producto->id_marca = $request->id_marca;
        $producto->id_categoria = $request->id_categoria;
        $producto->imagen = $imagenPath ?? null; // Asigna la ruta de la imagen
        $producto->save();

        return redirect()->route('productos.index')
            ->with('success', 'Producto creado correctamente.');
    }


    // Mostrar un producto específico
    public function show(Producto $producto)
    {
        return view('admin.productos.show', compact('producto'));
    }

    // Mostrar el formulario de edición
    public function edit(Producto $producto)
    {
        return view('admin.productos.edit', compact('producto'));
    }

    // Actualizar un producto
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'id_tipo_ropa' => 'required|exists:tipo_ropas,id',
            'precio' => 'required|numeric',
            'id_marca' => 'required|exists:marcas,id',
            'id_categoria' => 'required|exists:categorias,id',
            'imagen' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048', // 2MB max
        ]);

        if ($validator->fails()) {
            return redirect()->route('productos.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }

        $producto = Producto::find($id);
        $producto->id_tipo_ropa = $request->id_tipo_ropa;
        $producto->precio = $request->precio;
        $producto->id_marca = $request->id_marca;
        $producto->id_categoria = $request->id_categoria;

        // Guardar la nueva imagen si se ha subido
        if ($request->hasFile('imagen')) {
            // Eliminar la imagen anterior si es necesario
            if ($producto->imagen) {
                Storage::disk('public')->delete($producto->imagen);
            }
            $imagenPath = $request->file('imagen')->store('imagenes', 'public');
            $producto->imagen = $imagenPath;
        }

        $producto->save();

        return redirect()->route('productos.index')
            ->with('success', 'Producto actualizado correctamente.');
    }
    // Eliminar un producto
    public function destroy(Producto $producto)
    {
        $producto->delete();

        return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente.');
    }
}
