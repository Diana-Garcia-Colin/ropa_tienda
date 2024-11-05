@extends('layouts.dash')

@section('content')
    <h2>Crear Nueva Asignación de Talla</h2>

    <form action="{{ route('asig_talla.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="id_entrada">Entrada</label>
            <select name="id_entrada" id="id_entrada" class="form-control" required>
                <option value="">Seleccione una entrada</option>
                @foreach ($entradas as $entrada)
                    <option value="{{ $entrada->id }}">{{ $entrada->id }}</option>
                @endforeach
            </select>
            @error('id_entrada')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="cantidad">Cantidad</label>
            <input type="number" name="cantidad" id="cantidad" class="form-control" required>
            @error('cantidad')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="id_talla">Talla</label>
            <select name="id_talla" id="id_talla" class="form-control" required>
                <option value="">Seleccione una talla</option>
                @foreach ($tallas as $talla)
                    <option value="{{ $talla->id }}">{{ $talla->talla }}</option>
                @endforeach
            </select>
            @error('id_talla')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('asig_talla.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection
