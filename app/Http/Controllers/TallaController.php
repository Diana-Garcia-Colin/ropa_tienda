<?php

namespace App\Http\Controllers;

use App\Models\Talla;
use Illuminate\Http\Request;
class TallaController extends Controller
{
    public function index()
    {
        $tallas = Talla::paginate(10);
        return view('admin.tallas.index', compact('tallas'));
    }

    public function create()
    {
        return view('admin.tallas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tallas' => 'required|string|max:255', // Cambiado a 'tallas'
        ]);

        Talla::create([
            'talla' => $request->tallas, // Cambiado a $request->tallas
        ]);

        return redirect()->route('tallas.index')->with('success', 'Talla creada con éxito.');
    }

    public function show(Talla $talla)
    {
        return view('admin.tallas.show', compact('talla'));
    }

    public function edit(Talla $talla)
    {
        return view('admin.tallas.edit', compact('talla'));
    }

    public function update(Request $request, Talla $talla)
    {
        $request->validate([
            'tallas' => 'required|string|max:255', // Cambiado a 'tallas'
        ]);

        $talla->update($request->only('tallas')); // Cambiado a 'tallas'

        return redirect()->route('tallas.index')->with('success', 'Talla actualizada con éxito.');
    }

    public function destroy(Talla $talla)
    {
        $talla->delete();

        return redirect()->route('tallas.index')->with('success', 'Talla eliminada con éxito.');
    }
}
