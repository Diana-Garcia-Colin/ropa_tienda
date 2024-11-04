@extends('layouts.dash')

@section('content')

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Editar Entrada</h2> <!-- Cambié "Añadir" por "Editar" -->
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('entradas.index') }}"> Volver</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>¡Vaya!</strong> Hubo algunos problemas con la entrada.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('entradas.update', $entrada->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Método para indicar que se está actualizando -->

        <div class="row">
            <!-- Proveedor -->
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Proveedor:</strong>
                    <select name="id_proveedor" id="id_proveedor" class="form-control" required>
                        <option value="">Seleccione un proveedor</option>
                        @foreach ($proveedores as $proveedor)
                            <option value="{{ $proveedor->id_proveedor }}" {{ $entrada->id_proveedor == $proveedor->id_proveedor ? 'selected' : '' }}>
                                {{ $proveedor->user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Producto -->
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Producto:</strong>
                    <select name="id_producto" id="id_producto" class="form-control" required>
                        <option value="">Seleccione un producto</option>
                        @foreach ($productos as $producto)
                            <option value="{{ $producto->id }}" {{ $entrada->id_producto == $producto->id ? 'selected' : '' }}>
                                {{ $producto->tipoRopa->tipo }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Precio de Entrada -->
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Precio de Entrada:</strong>
                    <input type="number" name="precio_entrada" id="precio_entrada" class="form-control" placeholder="Precio de entrada" value="{{ $entrada->precio_entrada }}" required>
                </div>
            </div>

            <!-- Fecha de Entrada -->
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Fecha de Entrada:</strong>
                    <input type="date" name="fecha_entrada" id="fecha_entrada" class="form-control" value="{{ $entrada->fecha_entrada }}" required>
                </div>
            </div>

            <!-- Botón de envío -->
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Actualizar Entrada</button> <!-- Cambié "Crear" por "Actualizar" -->
            </div>
        </div>
    </form>

@endsection
