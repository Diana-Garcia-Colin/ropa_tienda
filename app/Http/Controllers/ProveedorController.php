<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Proveedor;
use App\Models\Empresa;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class ProveedorController extends Controller
{

    public function proveedorUsers()
    {
        $users = User::role('proveedor')->get(); // Obtiene usuarios con rol 'proveedor'
        $empresas = Empresa::all(); // Obtiene todas las empresas
        $roles = Role::all(); // Obtiene todos los roles (si también lo necesitas)

        return view('usuarios.proveedor', compact('users', 'empresas', 'roles')); // Pasa usuarios, empresas y roles a la vista
    }



    public function index()
    {
        // Cargar proveedores con sus usuarios y empresas
        $proveedores = Proveedor::with(['user', 'empresa'])->paginate(10); // Cambia el número a tu preferencia

        return view('admin.proveedores.index', compact('proveedores'));
    }



    public function create()
    {
        $users = User::role('proveedor')->get(); // Obtiene usuarios con rol 'proveedor'
        $empresas = Empresa::all(); // Obtiene todas las empresas
        $roles = Role::all(); // Obtiene todos los roles

        return view('admin.proveedores.create', compact('users', 'empresas', 'roles')); // Pasa usuarios, empresas y roles a la vista
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id', // Validación para el usuario
            'id_empresa' => 'required|exists:empresas,id', // Cambia id_empresa a id
        ]);
    
        Proveedor::create([
            'user_id' => $validatedData['user_id'], 
            'id_empresa' => $validatedData['id_empresa'], // Asegúrate de usar el id validado
        ]);
    
        return redirect()->route('proveedores.index')->with('success', 'Proveedor creado correctamente.');
    }


    public function show(Proveedor $proveedore)
    {
        return view('proveedores.show', compact('proveedore')); // Muestra detalles de un proveedor
    }

    public function edit($id)
    {
        $proveedor = Proveedor::findOrFail($id);
        $users = User::role('empleado')->get(); // Obtiene solo usuarios con rol 'empleado'
        $empresas = Empresa::all(); // Obtiene todas las empresas

        return view('admin.proveedores.edit', compact('proveedor', 'users', 'empresas'));
    }


    public function update(Request $request, Proveedor $proveedore)
{
    $validatedData = $request->validate([
        'id_user' => 'required|exists:users,id', // Cambia id_user a user_id
        'id_empresa' => 'required|exists:empresas,id', // Cambia id_empresa a id
    ]);

    $proveedore->update($validatedData);
    return redirect()->route('proveedores.index')->with('success', 'Proveedor actualizado correctamente.');
}


    public function destroy(Proveedor $proveedore)
    {
        $proveedore->delete(); // Elimina el proveedor
        return redirect()->route('proveedores.index')->with('success', 'Proveedor eliminado correctamente.');
    }
}
