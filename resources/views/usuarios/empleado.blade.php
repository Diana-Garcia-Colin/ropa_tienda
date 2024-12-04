@extends('layouts.dash')

@section('content')
<div class="container mt-4">
    <h1>Usuarios con el rol de Empleados</h1>
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
                    <form action="{{ route('admin.update.role', $user->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <select name="role" class="form-select" onchange="this.form.submit()">
                            @foreach($roles as $role)
                                <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                    {{ ucfirst($role->name) }}
                                </option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary btn-sm mt-2">Actualizar Rol</button>
                    </form>
                </td>
            
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

