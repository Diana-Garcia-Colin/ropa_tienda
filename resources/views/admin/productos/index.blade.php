@extends('layouts.dash')

@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Productos</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('productos.create') }}"> Crear nuevo producto</a>
                <a class="btn btn-primary" href="{{ route('home') }}"> Volver</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    @php
        $i = 0; // Inicializar la variable $i
    @endphp

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Tipo de Ropa</th>
            <th>Marca</th>
            <th>Categoría</th>
            <th>Precio</th>
            <th>Imagen</th>
            <th width="280px">Acciones</th>
        </tr>

        @foreach ($productos as $producto)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $producto->tipoRopa->tipo ?? 'Sin tipo' }}</td>
                <td>{{ $producto->marca->marca ?? 'Sin marca' }}</td>
                <td>{{ $producto->categoria->categoria ?? 'Sin categoría' }}</td>
                <td>{{ $producto->precio }}</td>
                <td>
                    @if($producto->imagen)
                        <img src="{{ asset('storage/' . $producto->imagen) }}" alt="Imagen de producto" width="50">
                    @else
                        Sin imagen
                    @endif
                </td>
                <td>
                    <form action="{{ route('productos.destroy', $producto->id) }}" method="POST">
                        <a class="btn btn-primary" href="{{ route('productos.edit', $producto->id) }}">Editar</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    {!! $productos->links() !!}

@endsection
