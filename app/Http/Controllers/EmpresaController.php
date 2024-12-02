<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    /**
     * Muestra una lista de todas las empresas.
     */
    public function index()
    {
        $empresas = Empresa::paginate(10); // Cambia 10 por el número deseado de elementos por página
        return view('admin.empresas.index', compact('empresas'));
    }

    /**
     * Muestra el formulario para crear una nueva empresa.
     */
    public function create()
    {
        return view('admin.empresas.create');
    }

    /**
     * Almacena una nueva empresa en la base de datos.
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'nom_e' => 'required|string|max:255|unique:empresas,nom_e',
        ]);

        // Crear una nueva empresa
        Empresa::create([
            'nom_e' => $request->nom_e,
        ]);

        // Redirigir con un mensaje de éxito
        return redirect()->route('empresas.index')->with('success', 'Empresa creada exitosamente.');
    }

    /**
     * Muestra los detalles de una empresa específica.
     */
    public function show(Empresa $empresa)
    {
        return view('admin.empresas.show', compact('empresa'));
    }

    /**
     * Muestra el formulario para editar una empresa.
     */
    public function edit(Empresa $empresa)
    {
        return view('admin.empresas.edit', compact('empresa'));
    }

    /**
     * Actualiza los datos de una empresa en la base de datos.
     */
    public function update(Request $request, Empresa $empresa)
    {
        // Validar los datos de entrada
        $request->validate([
            'nom_e' => 'required|string|max:255|unique:empresas,nom_e,' . $empresa->id,
        ]);

        // Actualizar la empresa
        $empresa->update([
            'nom_e' => $request->nom_e,
        ]);

        // Redirigir con un mensaje de éxito
        return redirect()->route('empresas.index')->with('success', 'Empresa actualizada exitosamente.');
    }

    /**
     * Elimina una empresa de la base de datos.
     */
    public function destroy(Empresa $empresa)
    {
        $empresa->delete();

        // Redirigir con un mensaje de éxito
        return redirect()->route('empresas.index')->with('success', 'Empresa eliminada exitosamente.');
    }
}
