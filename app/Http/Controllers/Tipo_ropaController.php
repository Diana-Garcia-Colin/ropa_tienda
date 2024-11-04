<?php

namespace App\Http\Controllers;

use App\Models\Tipo_ropa;
use Illuminate\Http\Request;

class Tipo_ropaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tipo_ropas = Tipo_ropa::paginate(10); // Cambia 10 por el número de elementos que desees mostrar por página
        return view('admin.tipo_ropas.index', compact('tipo_ropas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tipo_ropas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tipo' => 'required|string|max:255',
        ]);

        // Crear un nuevo producto
        Tipo_ropa::create([
            'tipo' => $request->tipo,
        ]);

        // Redirigir a la lista de productos con un mensaje de éxito
        return redirect()->route('tipo_ropas.index')->with('success', 'Tipo ropa created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tipo_ropa $tipo_ropa)
    {
        return view('admin.tipo_ropas.show', compact('tipo_ropa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tipo_ropa $tipo_ropa)
    {
        return view('admin.tipo_ropas.edit', compact('tipo_ropa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tipo_ropa $tipo_ropa)
    {
        $request->validate([
            'tipo' => 'required|string|max:255',
        ]);

        // Actualizar el producto
        $tipo_ropa->update($request->only('tipo'));

        // Redirigir con mensaje de éxito
        return redirect()->route('tipo_ropas.index')->with('success', 'Tipo ropa updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tipo_ropa $tipo_ropa)
    {
        $tipo_ropa->delete();
        return redirect()->route('tipo_ropas.index')->with('success', 'Tipo ropa deleted successfully.');
    }
}

