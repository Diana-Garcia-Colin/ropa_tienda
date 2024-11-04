<?php

namespace App\Http\Controllers;
use Illuminate\View\View;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = Categoria::paginate(10); // Cambia 10 por el número de elementos que desees mostrar por página
        return view('admin.categorias.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categorias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'categoria' => 'required|string|max:255',
        ]);

        // Crear un nuevo producto
        Categoria::create([
            'categoria' => $request->categoria,
        ]);

        // Redirigir a la lista de productos con un mensaje de éxito
        return redirect()->route('categorias.index')->with('success', 'Categoria created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Categoria $categoria)
    {
        return view('admin.categorias.show', compact('categoria'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categoria $categoria)
    {
        return view('admin.categorias.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categoria $categoria)
    {
        $request->validate([
            'categoria' => 'required|string|max:255',
        ]);

        // Actualizar el producto
        $categoria->update($request->only('categoria'));

        // Redirigir con mensaje de éxito
        return redirect()->route('categorias.index')->with('success', 'Categoria updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria)
    {
        $categoria->delete();

        // Redirigir a la lista de productos con un mensaje de éxito
        return redirect()->route('categorias.index')->with('success', 'Categoria deleted successfully.');
    }
}
