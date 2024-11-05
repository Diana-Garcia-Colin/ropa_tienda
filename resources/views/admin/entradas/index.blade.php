@extends('layouts.dash')

@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Entradas</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('entradas.create') }}"> Añadir Entrada</a>
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
            <th>No</th>
            <th>Proveedor</th>
            <th>Producto</th>
            <th>Precio de Entrada</th>
            <th>Fecha de Entrada</th>
            <th width="280px">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @if ($entradas->count() > 0)
            @foreach ($entradas as $entrada)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $entrada->proveedor->user->name ?? 'N/A' }}</td> <!-- Asegúrate que este sea el campo correcto -->
                    <td>{{ $entrada->producto->tipoRopa->tipo ?? 'N/A' }}</td> <!-- Asegúrate que este sea el campo correcto -->
                    <td>{{ $entrada->precio_entrada }}</td>
                    <td>{{ $entrada->fecha_entrada }}</td>
                    <td>
                       
                        <a class="btn btn-primary" href="{{ route('entradas.edit', $entrada->id) }}">Editar</a>
                        <form action="{{ route('entradas.destroy', $entrada->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="6" class="text-center">No hay entradas disponibles.</td>
            </tr>
        @endif
        </tbody>
    </table>

    {{ $entradas->links() }}

@endsection
