@extends('layouts.dash')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Lista de Proveedores</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('proveedores.create') }}"> Crear Nuevo Proveedor</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID Proveedor</th>
            <th>Usuario</th>
            <th>Marca</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($proveedores as $proveedor)
            <tr>
                <td>{{ $proveedor->id_proveedor }}</td>
                <td>{{ $proveedor->user->name }}</td> <!-- Accediendo al nombre del usuario -->
                <td>{{ $proveedor->empresa->nom_e }}</td> <!-- Accediendo al nombre de la empresa -->
                <td>
                    <form action="{{ route('proveedores.destroy', $proveedor->id_proveedor) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('proveedores.show', $proveedor->id_proveedor) }}">Mostrar</a>
                        <a class="btn btn-primary" href="{{ route('proveedores.edit', $proveedor->id_proveedor) }}">Editar</a>

                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este proveedor?')">Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {!! $proveedores->links() !!} <!-- Para paginación -->
@endsection
