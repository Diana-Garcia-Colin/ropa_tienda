@extends('layouts.dash')

@section('content')
<div class="container mt-4">
    <h1>Usuarios con el rol de Proveedores</h1>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Empresa</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <form action="{{ route('admin.update.role', $user->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <select name="role" class="form-select">
                            @foreach($roles as $role)
                                <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                    {{ ucfirst($role->name) }}
                                </option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary btn-sm mt-2">Actualizar Rol</button>
                    </form>
                </td>
                <td>
                    <form action="{{ route('admin.update.empresa', $user->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <select name="empresa_id" class="form-select">
                            <option value="">Selecciona una empresa</option>
                            @foreach($empresas as $empresa)
                                <option value="{{ $empresa->id }}" {{ $user->empresa_id == $empresa->id ? 'selected' : '' }}>
                                    {{ $empresa->nom_e }}
                                </option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary btn-sm mt-2">Asignar Empresa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
