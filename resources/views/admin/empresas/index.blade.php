@extends('layouts.dash') {{-- Asegúrate de que esta vista extienda un layout válido --}}

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Lista de Empresas</h2>
            </div>
            <div class="pull-right mb-3">
                <a class="btn btn-success" href="{{ route('empresas.create') }}">Crear Nueva Empresa</a>
                <a class="btn btn-primary" href="{{ route('home') }}">Volver</a>
            </div>
        </div>
    </div>

    {{-- Mostrar mensaje de éxito si existe --}}
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>No</th>
            <th>Nombre Empresa</th>
            <th width="280px">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($empresas as $key => $empresa)
            <tr>
                <td>{{ $loop->iteration }}</td> {{-- Reemplaza $i por $loop->iteration --}}
                <td>{{ $empresa->nom_e }}</td>
                <td>
                    <form action="{{ route('empresas.destroy', $empresa->id) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('empresas.show', $empresa->id) }}">Ver</a>
                        <a class="btn btn-primary" href="{{ route('empresas.edit', $empresa->id) }}">Editar</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta empresa?')">Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{-- Paginación --}}
    <div class="d-flex justify-content-center">
        {!! $empresas->links() !!}
    </div>
@endsection
