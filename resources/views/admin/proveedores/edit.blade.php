@extends('layouts.dash')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Editar Proveedor</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('proveedores.index') }}"> Regresar</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>¡Quién lo diría!</strong> Hay algunos problemas con tus entradas.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('proveedores.update', $proveedor->id_proveedor) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <!-- Selección de Usuario -->
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Usuario:</strong>
                    <select name="user_id" class="form-control" required> <!-- Añadido required para validación -->
                        <option value="">Seleccione un Usuario</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ $user->id == $proveedor->user_id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('user_id'))
                        <small class="text-danger">{{ $errors->first('user_id') }}</small>
                    @endif
                </div>
            </div>

            <!-- Selección de Empresa -->
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Empresa:</strong>
                    <select name="id_empresa" class="form-control" required> <!-- Añadido required para validación -->
                        <option value="">Seleccione una Empresa</option>
                        @foreach ($empresas as $empresa)
                            <option value="{{ $empresa->id }}" {{ $empresa->id == $proveedor->id_empresa ? 'selected' : '' }}>
                                {{ $empresa->nom_e }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('id_empresa'))
                        <small class="text-danger">{{ $errors->first('id_empresa') }}</small>
                    @endif
                </div>
            </div>

            <!-- Botón de Enviar -->
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-success">Actualizar</button>
            </div>
        </div>
    </form>
@endsection
