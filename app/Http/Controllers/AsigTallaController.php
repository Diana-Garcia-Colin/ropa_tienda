<?php

namespace App\Http\Controllers;

use App\Models\AsigTalla;
use App\Models\Entrada;
use App\Models\Talla;
use Illuminate\Http\Request;

class AsigTallaController extends Controller
{
    public function index()
    {
        $asigTallas = AsigTalla::with(['entrada', 'talla'])->paginate(10);
        return view('admin.asig_talla.index', compact('asigTallas'));
    }

    public function create()
    {
        $entradas = Entrada::all();
        $tallas = Talla::all();
        return view('admin.asig_talla.create', compact('entradas', 'tallas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_entrada' => 'required|exists:entradas,id',
            'cantidad' => 'required|integer',
            'id_talla' => 'required|exists:tallas,id',
        ]);

        AsigTalla::create($request->all());
        return redirect()->route('asig_talla.index')->with('success', 'Asignación de talla creada exitosamente.');
    }

    public function edit(AsigTalla $asigTalla)
    {
        $entradas = Entrada::all();
        $tallas = Talla::all();
        return view('admin.asig_talla.edit', compact('asigTalla', 'entradas', 'tallas'));
    }

    public function update(Request $request, AsigTalla $asigTalla)
    {
        $request->validate([
            'id_entrada' => 'required|exists:entradas,id',
            'cantidad' => 'required|integer',
            'id_talla' => 'required|exists:tallas,id',
        ]);

        $asigTalla->update($request->all());
        return redirect()->route('asig_talla.index')->with('success', 'Asignación de talla actualizada correctamente.');
    }

    public function destroy(AsigTalla $asigTalla)
    {
        $asigTalla->delete();
        return redirect()->route('asig_talla.index')->with('success', 'Asignación de talla eliminada correctamente.');
    }
}
