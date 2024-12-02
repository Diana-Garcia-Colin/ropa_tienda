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
    <div class="mb-3"></div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="row">
        @foreach ($productos as $producto)
            <div class="col-md-3 mb-4"> <!-- Cuatro tarjetas por fila -->
                <div class="card">
                    <img src="{{ $producto->imagen ? asset('storage/' . $producto->imagen) : 'ruta/a/imagen/placeholder.jpg' }}"
                         class="card-img-top" alt="Imagen de producto"
                         style="object-fit: contain; height: 200px;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $producto->tipoRopa->tipo ?? 'Sin tipo' }}</h5>
                        <p class="card-text">Marca: {{ $producto->marca->marca ?? 'Sin marca' }}</p>
                        <p class="card-text">Categoría: {{ $producto->categoria->categoria ?? 'Sin categoría' }}</p>
                        <p class="card-text">Precio: ${{ number_format($producto->precio, 2) }}</p>
                        <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-primary">Editar</a>
                        <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {!! $productos->links() !!}

@endsection
