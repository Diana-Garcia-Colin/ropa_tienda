<!-- resources/views/admin/usuarios_no_aprobados.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Usuarios No Aprobados</h2>
        <a class="btn btn-primary mb-3" href="{{ route('home') }}">Volver</a>
        
        <table class="table">
            <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <form action="{{ route('admin.approve.user', $user->id) }}" method="POST">
                            @csrf
                            <select name="role" required class="form-select">
                                <option value="">Selecciona un rol</option>
                                <option value="admin">Admin</option>
                                <option value="proveedor">Proveedor</option>
                                <option value="cliente">Cliente</option>
                                <option value="empleado">Empleado</option>
                            </select>
                            <button type="submit" class="btn btn-success mt-2">Aprobar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
