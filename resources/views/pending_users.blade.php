<!-- resources/views/pending_users.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Usuarios Pendientes de Aprobación</h2>
        <table class="table">
            <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Asignar Rol</th>
                <th>Acción</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <form action="{{ route('approve.user', $user->id) }}" method="POST">
                            @csrf
                            <select name="role" required>
                                <option value="proveedor">Proveedor</option>
                                <option value="cliente">Cliente</option>
                                <option value="empleado">Empleado</option>
                            </select>
                            <button type="submit" class="btn btn-primary">Aprobar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
