@extends('layouts.dash')

@section('content')
    <h2>Editar Asignación de Talla</h2>

    <form action="{{ route('asig_talla.update', $asigTalla->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="id_entrada">Entrada</label>
            <select name="id_entrada" id="id_entrada" class="form-control" required>
                <option value="">Seleccione una entrada</option>
                @foreach ($entradas as $entrada)
                    <option value="{{ $entrada->id }}" {{ $asigTalla->id_entrada == $entrada->id ? 'selected' : '' }}>
                        {{ $entrada->id }}
                    </option>
                @endforeach
            </select>
            @error('id_entrada')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="cantidad">Cantidad</label>
            <input type="number" name="cantidad" id="cantidad" class="form-control" value="{{ $asigTalla->cantidad }}" required>
            @error('cantidad')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="form-group">
            <label for="id_talla">Talla</label>
            <select name="id_talla" id="id_talla" class="form-control" required>
                <option value="">Seleccione una talla</option>
                @foreach ($tallas as $talla)
                    <option value="{{ $talla->id }}" {{ $asigTalla->id_talla == $talla->talla ? 'selected' : '' }}>
                        {{ $talla->talla }}
                    </option>
                @endforeach
            </select>
            @error('id_talla')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('asig_talla.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection
