<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $empresas = Empresa::paginate(10); // Cambia 10 por el número de elementos que desees mostrar por página
        return view('admin.empresas.index', compact('empresas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.empresas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom_e' => 'required|string|max:255',
        ]);

        // Crear un nuevo producto
        Empresa::create([
            'nom_e' => $request->nom_e,
        ]);

        // Redirigir a la lista de productos con un mensaje de éxito
        return redirect()->route('empresas.index')->with('success', 'Empresa created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Empresa $empresa)
    {
        return view('admin.empresas.show', compact('empresa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Empresa $empresa)
    {
        return view('admin.empresas.edit', compact('empresa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Empresa $empresa)
    {
        $request->validate([
            'nom_e' => 'required|string|max:255',
        ]);

        // Actualizar el producto
        $empresa->update($request->only('nom_e'));

        // Redirigir con mensaje de éxito
        return redirect()->route('empresas.index')->with('success', 'Empresa updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empresa $empresa)
    {
        $empresa->delete();

        // Redirigir a la lista de productos con un mensaje de éxito
        return redirect()->route('empresas.index')->with('success', 'Empresa deleted successfully.');
    }
}
