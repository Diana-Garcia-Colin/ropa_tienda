@extends('layouts.dash')

@section('content')
    <h2>Lista de Asignaciones de Tallas</h2>
    <a href="{{ route('asig_talla.create') }}" class="btn btn-success">Crear Nueva Asignación</a>

    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Entrada</th>
            <th>Cantidad</th>
            <th>Talla</th>
            <th>Acciones</th>
        </tr>
        @foreach ($asigTallas as $asigTalla)
            <tr>
                <td>{{ $asigTalla->id }}</td>
                <td>{{ $asigTalla->entrada->id }}</td>
                <td>{{ $asigTalla->cantidad }}</td>
                <td>{{ $asigTalla->talla->talla }}</td>
                <td>
                    <a href="{{ route('asig_talla.edit', $asigTalla->id) }}" class="btn btn-primary">Editar</a>
                    <form action="{{ route('asig_talla.destroy', $asigTalla->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    {!! $asigTallas->links() !!}
@endsection
