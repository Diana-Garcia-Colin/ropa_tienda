@extends('layouts.dash')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Lista de Empleados</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('empleados.create') }}"> Crear Nuevo Empleado</a>
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
            <th>ID Empleado</th>
            <th>Nombre Completo</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($empleados as $empleado)
            <tr>
                <td>{{ $empleado->id_empleado }}</td>
                <td>{{ $empleado->user->name }} {{ $empleado->user->ap }} {{ $empleado->user->am }}</td>
                <td>
                    <form action="{{ route('empleados.destroy', $empleado->id_empleado) }}" method="POST">
                        <a class="btn btn-primary" href="{{ route('empleados.edit', $empleado->id_empleado) }}">Editar</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este empleado?')">Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {!! $empleados->links() !!}
@endsection
