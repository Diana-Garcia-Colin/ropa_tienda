@extends('layouts.dash')

@section('content')
<div class="container mt-4">
    <h1>Usuarios con el rol de Cliente</h1>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <form action="{{ route('admin.updateRole', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <select name="role" class="form-select" onchange="this.form.submit()">
                            <option value="admin" {{ $user->hasRole('admin') ? 'selected' : '' }}>Admin</option>
                            <option value="proveedor" {{ $user->hasRole('proveedor') ? 'selected' : '' }}>Proveedor</option>
                            <option value="cliente" {{ $user->hasRole('cliente') ? 'selected' : '' }}>Cliente</option>
                            <option value="empleado" {{ $user->hasRole('empleado') ? 'selected' : '' }}>Empleado</option>
                        </select>
                    </form>
                </td>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
