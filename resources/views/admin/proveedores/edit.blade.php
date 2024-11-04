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
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Usuario:</strong>
                    <select name="id_user" class="form-control">
                        <option value="">Seleccione un Usuario</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ $user->id == $proveedor->id_user ? 'selected' : '' }}>{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Marca:</strong>
                    <select name="id_empresa" class="form-control">
                        <option value="">Seleccione una Marca</option>
                        @foreach ($empresas as $empresa)
                            <option value="{{ $empresa->id }}" {{ $empresa->id == $proveedor->id_empresa ? 'selected' : '' }}>{{ $empresa->nom_e }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-success">Actualizar</button>
            </div>
        </div>
    </form>
@endsection
